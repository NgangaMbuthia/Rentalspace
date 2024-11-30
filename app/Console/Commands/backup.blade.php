<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Backend\Entities\Tenant;
use App\Helpers\Helper;
use Modules\Backend\Entities\TenantCharges;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\InvoiceItem;
use DB;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Reports\InvoicePDf;
use App\TenantMonthlyReport;
use Modules\Backend\Entities\Space;


class sendInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sendInvoices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Sends Invoices to Tenants Every End Month reminding them to pay rent';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

      $models=Tenant::where(['current_status'=>"Active"])->get();


         


      foreach($models as $model){




        $charges=TenantCharges::where(['tenant_id'=>$model->id])->where('charge_name','!=','Deposit')->get();

         
        try{
          
          $charge_amount=$charges->sum('amount');

           
          $invoice=Invoice::where(['issued_to'=>$model->user_id,'month'=>date("M"),'year'=>date("Y"),'space_id'=>$model->space_id,'type'=>'Rent'])->first();
          if(!$invoice)
           {
           $invoice=new Invoice();
           $invoice->issued_to=$model->user_id;
           $invoice->space_id=$model->space_id;
           $invoice->provider_id=$model->provider_id;
           $invoice->issue_date=date('Y-m-d');
           $invoice->amount=$charge_amount;
           $invoice->status="Pending";
           $invoice->month=date('M');
           $invoice->year=date('Y');
           $invoice->type="Rent";
           $invoice->invoice_sent="Yes";
           $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+7 days"));
           $invoice->invoice_number="#".substr(number_format(time() * rand(),0,'',''),0,6);
           $invoice->description="Being Invoice for Rent Payment for space number ".$model->space->number." ,at ".$model->space->property->title;
          $invoice->save();

              foreach($charges as $key)
              {
                 
                $component=new InvoiceItem();
                $component->invoice_id=$invoice->id;
                $component->code=$key->charge_code;
                $component->name=$key->charge_name;
                $component->amount=$key->amount;
                $component->amount_paid=0;
                $component->balance=$component->amount;
                $component->save();
                 }
           $this->createCreditPayment($invoice,$model->id);
         
           }

          $this->createSummary($invoice,$model->id);
          

        }catch(\Exception $e){
        }
          

    }

     $this->loopThroughUnOccupiedSpaces();

  }

  public function createSummary($invoice,$tenant)
  {
    
    $payment=TenantMonthlyReport::where(['tenant_id'=>$tenant,'month'=>$invoice->month,'year'=>$invoice->year,'space_id'=>$invoice->space_id])->first();
     if(!$payment)
     {
       $payment=new TenantMonthlyReport();
       $payment->tenant_id=$tenant;
       $payment->space_id=$invoice->space_id;
       $payment->month=$invoice->month;
       $payment->year=$invoice->year;
       $payment->pre_balance=$this->PreviousBalance($invoice->space_id);

       $payment->invoice_amount=$invoice->amount;
       $payment->new_balance=$payment->pre_balance+$payment->invoice_amount;
       $payment->amount_paid=0;
       $payment->balance=$payment->new_balance-$payment->amount_paid;
       $payment->save();
        

     }


    
  }

  public function PreviousBalance($invoice)
  {
    $payment=TenantMonthlyReport::where(['space_id'=>$invoice])->latest('id')->first();
     
     
     if($payment)
     {
      return $payment->balance;
     }else{
      return 0;
     }

  }


  protected function createCreditPayment($invoice,$tenant_id){
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
      $payment->year=date("Y");
      $payment->type="Rent";
      $payment->transaction_date=date('Y-m-d');
      $payment->system_transaction_number=str_random(8);
      $payment->month=date('m');
      $payment->reference_number=$invoice->invoice_number."/". str_random(4);
      $payment->description="Request For Rent Payment for Invoice ".$invoice->invoice_number;
      $payment->save();
      $provider=$this->getProvider($payment->provider_id);
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
     
  

    if($lastpayment->balance-$invoice->amount<0)
    {
    $this->sendSMSNotifications($invoice);
    }
    


  }
  catch(\Exception $e)
  {

   return false;

 }

}



public function sendSMSNotifications($model){
  return true;


 if(Helper::testModule("SMS and Bulk Emails Module",$model->provider_id)){
    

  $phone=$model->user->profile->telephone;

  $message="Dear ".$model->user->name." a new Invoice for this month (".date('F,Y').")rent payment has been emailed to you.The invoice Number is ".$model->invoice_number;
  $phone=$model->user->profile->telephone;
  $email=$model->user->email;
  $provider=$this->getProvider($model->provider_id);
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

public function getProvider($model_id)
{  
 $provider=Agent::find($model_id);
 return ($provider)?$provider:false;

}

public function sendSMS($provider,$phone,$message)
{
           //dd($phone);
 $phone=str_replace('-', "", $phone);
  
 $phone=Helper::processNumber($phone);

 if($provider->has_api=="Yes")
 {
   $sms_provider=$provider->sms_provider;
   if(preg_match('/GEECKO/i', $sms_provider))
   {
     $this->sendGeeckoSMS($provider,$phone,$message);
   }else{

     $this->sendPSMS($provider,$phone,$message);
   }

 }else{
  $this->sendPSMS($provider,$phone,$message);
}
return true;

}


public function  sendGeeckoSMS($provider,$phone,$message)
{
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

public function sendEmail($provider,$model,$subject=null)
{

 if($subject==null)
 {
  $subject="Pending Invoice";
}
          //ALTER TABLE `agents` ADD `reply_email` VARCHAR(122) NULL AFTER `altenative_email`;
$user=$model->user;
$space=$model->space;
$property=$space->property;

          //ALTER TABLE `invoices` ADD `secret_key` VARCHAR(122) NULL AFTER `type`;

$pdfPath=InvoicePDf::sendMeNow($model,$provider);

}

public function loopThroughUnOccupiedSpaces()
{

  $spaces=Space::where(['status'=>'Free'])->get();
   
   foreach($spaces as $space)
   {
     $payment=new TenantMonthlyReport();
       $payment->tenant_id=null;
       $payment->space_id=$space->id;
       $payment->month=date('M');
       $payment->year=date('Y');
       $payment->pre_balance=$this->PreviousBalance($space->id);

       $payment->invoice_amount=0;
       $payment->new_balance=$payment->pre_balance+$payment->invoice_amount;
       $payment->amount_paid=0;
       $payment->balance=$payment->new_balance-$payment->amount_paid;
       $payment->space_status=0;
       $payment->save();
        

   }
}




}
