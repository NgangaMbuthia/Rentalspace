<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Support\Facades\Input;
use Auth;
use Response;
use App\User;
use Session;
use Hash;
use DateTime;
use Mail;
use App\AfricasTalkingGateway;
use App\SystemModule;
use App\ProviderModule;
use App\Message;
use Modules\Backend\Entities\Upload;
use Modules\UserManagement\Entities\Role;
use Modules\Backend\Entities\SMessage;
use Modules\Gate\Entities\GateGaurd;
use Modules\Gate\Entities\GateAssignment;
use Modules\Gate\Entities\Gate;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\PropertyImage;
use Modules\Backend\Entities\Plot;
use Modules\Backend\Entities\PlotImage;
use Modules\Backend\Entities\Tenant;
use App\Helpers\Helper;
use Modules\Backend\Entities\TenantCharges;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Reports\InvoicePDf;
use App\TenantMonthlyReport;
use Modules\Backend\Entities\Space;
use DB;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\InvoiceComponent;
use Modules\Backend\Entities\InvoiceItem;
use Modules\Backend\Entities\UtitlityBill;
use Modules\Backend\Entities\TenantSummary;
class InvoiceSender
{
	public static function send(){

     
  
    DB::beginTransaction();

      $properties=Property::where(['is_processed'=>0])->take(30)->get();
        foreach($properties as $main_property):
           
            

            $main_property->is_processed=1;
            $main_property->save();
    
		  $models=Tenant::join('spaces','spaces.id','=','tenants.space_id')
                ->where(['current_status'=>"Active","spaces.property_id"=>$main_property->id])
                ->select('tenants.id','space_id','spaces.property_id','user_id','provider_id')
                ->get();


         


    foreach($models as $model){
           
         
   $charges=TenantCharges::where(['tenant_id'=>$model->id])
                        ->where('charge_name','!=','Deposit')
                        ->get();
                        

        
         


         
        try{
          

          $charge_amount=$charges->sum('amount');
          
          
           

            if($charge_amount==0)
            {
              $charge_amount=$model->monthly_fee;
            }

             
           
          $invoice=Invoice::where(['issued_to'=>$model->user_id,'month'=>date("M",strtotime($date)),'year'=>date("Y",strtotime($date)),'space_id'=>$model->space_id,'type'=>'Rent'])
          ->first();



          if(!$invoice)
           {
           $invoice=new Invoice();
           $invoice->issued_to=$model->user_id;
           $invoice->space_id=$model->space_id;
           $invoice->provider_id=$model->provider_id;
           $invoice->issue_date=date('Y-m-d',strtotime($date));
           $invoice->amount=$charge_amount;
           $invoice->status="Pending";
           $invoice->month=date('M',strtotime($invoice->issue_date));
           $invoice->year=date('Y',strtotime($invoice->issue_date));
           $invoice->type="Rent";
           $invoice->invoice_sent="Yes";
           $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+7 days"));
           
           $invoice->invoice_number=self::getInvoiceNumber();
           $invoice->description="Being Invoice for Rent Payment for space number ".$model->space->number." ,at ".$model->space->property->title;
           $invoice->created_at=date('Y-m-d H:i:s',strtotime($invoice->issue_date));
          $invoice->save();
          foreach($charges as $key)
              {
                 
                  if($key->amount>0)
                  {
                    $component=new InvoiceItem();
                $component->invoice_id=$invoice->id;
                $component->code=strlen($key->charge_code>0)?$key->charge_code:100;
                $component->name=$key->charge_name;
                $component->amount=(strlen($key->amount)<1)?0:$key->amount;
                $component->amount_paid=0;
                $component->balance=$component->amount;
                $component->save();

                  }
                

             }

          self::createCreditPayment($invoice,$model->id);
          self::createSummary($invoice,$model->id);
         
           }
          

            
          
            
          DB::commit();
          

        }catch(\Exception $e){
           Helper::sendEmailToSupport($e);
        }
      

    }

     self::loopThroughUnOccupiedSpaces($main_property->id);   



   endforeach;

     
     Session::flash('success_msg','Invoices Generated success');
    return 1;



  }


	 
  public static  function createSummary($invoice,$tenant)
  {
    
    $payment=TenantMonthlyReport::where(['tenant_id'=>$tenant,'month'=>$invoice->month,'year'=>$invoice->year,'space_id'=>$invoice->space_id])->first();
    $space=Space::find($invoice->space_id);
    $property=$space->property;
     
           
     if(!$payment)
     {

       $payment=new TenantMonthlyReport();
       $payment->tenant_id=$tenant;
       $payment->space_id=$invoice->space_id;
       $payment->month=$invoice->month;
       $payment->year=$invoice->year;
       $payment->pre_balance=self::PreviousBalance($invoice->space_id);

       $payment->invoice_amount=$invoice->amount;
       $payment->new_balance=$payment->pre_balance+$payment->invoice_amount;
       $payment->amount_paid=($payment->pre_balance<0)?abs($payment->pre_balance):0;
       $payment->balance=$payment->new_balance-$payment->amount_paid;
       $payment->month_code=date('Ym',strtotime($invoice->issue_date));
       $payment->save();
      
        
         
          $tenantsummary=TenantSummary::where(['tenant_id'=>$tenant,'month'=>$payment->month,'year'=>$payment->year])->first();

            if(!$tenantsummary)
            {
               $tenantsummary=new TenantSummary();
               $tenantsummary->provider_id=($property)?$property->provider_id:null;
               $tenantsummary->property_id=($property)?$property->id:null;
               $tenantsummary->user_id=$invoice->issued_to;
               $tenantsummary->space_id=$invoice->space_id;
               $tenantsummary->tenant_id=$tenant;
               $tenantsummary->month=$payment->month;
               $tenantsummary->year=$payment->year;

               $tenantsummary->bal_brought_forward=$payment->pre_balance;
                if($tenantsummary->bal_brought_forward<0)
                {
                  $tenantsummary->amount_paid=abs($tenantsummary->bal_brought_forward);
                }else{
                  $tenantsummary->amount_paid=0;
                }
               $tenantsummary->invoice_amount=$payment->invoice_amount;
               $tenantsummary->outstanding_balance=($tenantsummary->bal_brought_forward+$tenantsummary->invoice_amount);
               $tenantsummary->new_balance=$tenantsummary->outstanding_balance-$tenantsummary->amount_paid;
               $tenantsummary->bal_carried_foward= $tenantsummary->new_balance;
                if($tenantsummary->bal_carried_foward==0)
                {
                  $tenantsummary->remarks="No Balance";
                }
                else if($tenantsummary->bal_carried_foward<0)
                {
                  $tenantsummary->remarks="Has Overpaid";
                }else{
                  $tenantsummary->remarks="Has Balance";
                }
                $tenantsummary->save();
                

               
            }

             
        

     }


    
  }


  public static  function getBalanceBroughtFoward($tenant)
    {

     
      $model=TenantSummary::where(['tenant_id'=>$tenant])->latest('id')->first();

      if($model)
      {
        $sum=$model->bal_brought_forward+$model->invoice_amount;
        $dif=$sum-$model->amount_paid;


        return $dif;
      }
      return 0;
    }

  public static function getInvoiceNumber()
  {
    $model=Invoice::latest('id')->first();
     return ($model)?$model->invoice_number+1:1000;
  }

  public static function PreviousBalance($invoice)
  {
    $payment=TenantMonthlyReport::where(['space_id'=>$invoice])->latest('id')->first();
      if($payment)
     {
      return $payment->balance;
     }else{
      return 0;
     }

  }


  protected static  function createCreditPayment($invoice,$tenant_id){
    try{

           
      $lastpayment=TenantPayment::where(['tenant_id'=>$tenant_id,'space_id'=>$invoice->space_id])->latest('id')->first();
        
      $payment=new TenantPayment();
      $payment->debit=0;
      $payment->payment_mode="Cash";
      $payment->credit=$invoice->amount;
      $payment->space_id=$invoice->space_id;
      $payment->invoice_id=$invoice->id;
      $payment->provider_id=$invoice->provider_id;
      $payment->tenant_id=$tenant_id;
      $payment->year=date("Y",strtotime($invoice->issue_date));
      $payment->type="Rent";
      $payment->transaction_date=date('Y-m-d',strtotime($invoice->issue_date));
      $payment->system_transaction_number=strtoupper(str_random(8));
      $payment->month=date('m',strtotime($invoice->issue_date));
      $payment->reference_number=$invoice->invoice_number."/". str_random(4);
      $payment->description="Request For Rent Payment for Invoice ".$invoice->invoice_number;
      $payment->save();
        
       
      $provider=self::getProvider($payment->provider_id);
      if($provider->encrypt_invoice=="Yes")
      {

        $method=$provider->method;

        if($method=="System")
        {
         $invoice->secret_key=strtoupper(str_random(5));
         $invoice->save();
       }
       else if($method=="Telephone")
       {
         $invoice->secret_key=str_replace('-','', $model->user->profile->telephone);
         $invoice->save();
       }else{

        $invoice->secret_key=$invoice->user->profile->id_number;
        $invoice->save();

      }

    }
     

 
       if($lastpayment)
       {
         if($lastpayment->balance-$invoice->amount<0)
          {
         self::sendSMSNotifications($invoice);
          }

       }else{
          self::sendSMSNotifications($invoice);
       }
   
    


  }
  catch(\Exception $e)
  {

    dd($e);

 }

}



public static function sendSMSNotifications($model){
    
     

 if(Helper::testModule("SMS and Bulk Emails Module",$model->provider_id)){
    

  $phone=$model->user->profile->telephone;


  $message="Dear ".$model->user->name." a new Invoice for this month (".date('F,Y').")rent payment has been emailed to you.The invoice Number is ".$model->invoice_number;
  $phone=$model->user->profile->telephone;
  $email=$model->user->email;
  $provider=self::getProvider($model->provider_id);
  if($provider)
  {
    if($provider->encrypt_invoice=="Yes")
    { 

      $message="Dear ".$model->user->name." a new Invoice for ".date('F,Y')." rent payment for ".$model->space->number."(".$model->space->property->title.") has been emailed to you.The invoice Number is ".$model->invoice_number." and is due ".$model->due_date.". Your secret Key for openning the invoice is ".$model->secret_key;

    }else{
      $message="Dear ".$model->user->name." a new Invoice for ".date('F,Y')." rent payment for ".$model->space->number."(".$model->space->property->title.") has been emailed to you.The invoice Number is ".$model->invoice_number." and is due ".$model->due_date;

    }
    
     
    //self::sendSMS($provider,$phone,$message);

    self::sendEmail($provider,$model,"New Invoice");



  }





}



}

public static function getProvider($model_id)
{  
 $provider=Agent::find($model_id);
 return ($provider)?$provider:false;

}

public static  function sendSMS($provider,$phone,$message)
{
  return true;
           //dd($phone);
 $phone=str_replace('-', "", $phone);
  
 $phone=Helper::processNumber($phone);

 if($provider->has_api=="Yes")
 {
   $sms_provider=$provider->sms_provider;
   if(preg_match('/GEECKO/i', $sms_provider))
   {
    self::sendGeeckoSMS($provider,$phone,$message);
   }else{

    self::sendPSMS($provider,$phone,$message);
   }

 }else{
  self::sendPSMS($provider,$phone,$message);
}
return true;

}


public static  function  sendGeeckoSMS($provider,$phone,$message)
{
  return true;
           //dd($provider);
 $url=$provider->sms_api_url;
 $send_name=$provider->sms_sender_name;
 $app_key=$provider->passkey;


 $to=str_replace('-', '', $phone);

 $data = array(
   "app_id" => $app_key,
   "sender_id"=>$send_name,
   "to" => array($to),
   "text"=>$message,

 );     


 $data_string = json_encode($data);   
 $curl = curl_init($url);                                                                      
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                                                                     
 curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);                                                                  
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
 curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
  'Content-Type: application/json',                                                                                
  'Content-Length: ' . strlen($data_string))                                                                       
);                                                                                                                   

 $result = curl_exec($curl);
 curl_close($curl);
 return $result;
}


public static function sendPSMS($provider,$phone,$message)
{

$phone="254719289389";
  $url=$provider->sms_api_url;
  $send_name=$provider->sms_sender_name;
  $app_key=$provider->passkey;
 try{

   $to=substr($to, 1,100);
   $post = [
    'key' => $app_key,
    'numbers' => $to,
    'text'   => $text,
    'sender_id'=>$send_name,

  ];
 $ch=curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
  $response = curl_exec($ch);
// close the connection, release resources used
  curl_close($ch);
        // do anything you want with your response
  $return_message=json_decode($response);
  $success=$return_message->success;
  return true;



}catch(\Exception $e)
{ 
 return false;
}
}

 public static function sendEmail($model,$invoice,$subject=null)
        {

          $tenant=Tenant::where(['user_id'=>$invoice->issued_to,'current_status'=>'Active'])->first();
               
            if($tenant && $tenant->is_emailable==1)
            {
               //InvoicePdf::genareEmailPDF($invoice,"hisanyad@gmail.com") ;   
          if($subject==null)
          {
            $subject="Pending Invoice";
          }
          $user=$invoice->user;


          $space=$invoice->space;
          $property=$space->property;
          $email=$user->email;
          
          $subject="Pending Invoice";
          $provider=$model;
          $agent_email=$provider->email;
          $agent_name=$provider->name;

           
             try{
            
              
              \Mail::send('emails.invoice', array('user' => $user,'space'=>$space,'model'=>$invoice,'provider'=>$provider), function ($message) use ($email, $subject,$agent_email,$agent_name) {
                $message->to($email)
                ->subject($subject)
                ->cc($agent_email, $agent_name)
                ->replyTo($agent_email, $agent_name)
                ->from($agent_email, $agent_name);
            });
               


             }catch(\Exception $e)
              {
                 dd($e);
              }
        

            }else{
              return  false;
            }
       
           
            
        }

public static function loopThroughUnOccupiedSpaces($id)
{

  $spaces=Space::where(['status'=>'Free','property_id'=>$id])->get();
    
     



   
   foreach($spaces as $space)
   {
        $payment=TenantMonthlyReport::where(['space_id'=>$space->id,'month'=>date('M'),'year'=>date('Y')])->first();
      $date=date('2019-06-01');
         if(!$payment)
         {
          $payment=new TenantMonthlyReport();
       $payment->tenant_id=null;
       $payment->space_id=$space->id;
       $payment->month=date('M',strtotime($date));
       $payment->year=date('Y',strtotime($date));
       $payment->month_code=date('Ym',strtotime($date));
       $payment->pre_balance=self::PreviousBalance($space->id);

       $payment->invoice_amount=0;
       $payment->new_balance=$payment->pre_balance+$payment->invoice_amount;
       $payment->amount_paid=0;
       $payment->balance=$payment->new_balance-$payment->amount_paid;
       $payment->space_status=0;
       $payment->save();

         }
     
        

   }
}







}