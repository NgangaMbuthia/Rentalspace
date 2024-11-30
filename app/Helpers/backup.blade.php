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
use DB;
use Modules\Backend\Entities\Agent;
class InvoiceSender
{
	public static function send(){

       dd("dhgghdghd");
  
   
		  $models=Tenant::where(['current_status'=>"Active",'provider_id'=>8])->get();

         foreach($models as $model){


          


         	

         	
          $charge=TenantCharges::where(['tenant_id'=>$model->id])->where('charge_name','!=','Deposit')->sum('amount');
              try{
              DB::beginTransaction();
              $invoice=Invoice::where(['space_id'=>$model->space_id,'issue_date'=>date('Y-m-d')])->first();

              if($invoice)
              {}else{

             
              $invoice=new Invoice();
              $invoice->issued_to=$model->user_id;
              $invoice->space_id=$model->space_id;
              $invoice->provider_id=$model->provider_id;
              $invoice->issue_date=date('Y-m-d');
              $invoice->amount=$charge;
              $invoice->status="Pending";
              $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+7 days"));
              $invoice->invoice_number="#".substr(number_format(time() * rand(),0,'',''),0,6);
              $invoice->description="Being Request for Rent payment for next ".date('F, Y').".Note late payment will attract penalty";
              $invoice->save();
              self::createCreditPayment($invoice,$model->id);

              }
              
               
               }catch(\Exception $e){
                  dd($e->getMessage());
                   

                   return false;

               }
              

         }
	}

	 protected  static function createCreditPayment($invoice,$tenant_id){
      try{
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
             
            self::sendSMSNotifications($invoice);
            DB::commit();
           


        }
        catch(\Exception $e)
            {
                 return false;

               }
             
        }

         public static  function sendSMSNotifications($model){
         	  
             return true;
             
                $phone=$model->user->profile->telephone;
                $email=$model->user->email;

                 $message="Dear ".$model->user->name." a new Invoice for ".date('F,Y')." rent payment for ".$model->space->number."(".$model->space->property->title.") has been emailed to you.The invoice Number is ".$model->invoice_number." and is due ".$model->due_date;
                  self::sendEmail($model);
                  self::sendGeeckoSMS($phone,$message);
                 
                  
             
             

        }

        public static function sendGeeckoSMS($phone,$message){
          return true;
        	$to=str_replace('-', '', $phone);
        	 
        	 $data = array(
         "app_id" => "23e2369ea94d4716bf1926e6df35e48b",
         "sender_id"=>'Geecko',
         "to" => array($to),
         "text"=>$message,

         );          

      $data_string = json_encode($data);   
      $curl = curl_init("http://geeckomessenger.geeckoltd.com/api/send");                                                                      
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


        public static function sendEmail($model,$subject=null)
        {

          if($subject==null)
          {
            $subject="Pending Invoice";
          }
        	$user=$model->user;
        	$space=$model->space;
        	$property=$space->property;
        	$email=$user->email;
        	$subject="Pending Invoice";
        	$provider=Agent::find($model->provider_id);
             try{
             	\Mail::send('emails.invoice', array('user' => $user,'space'=>$space,'model'=>$model,'provider'=>$provider), function ($message) use ($email, $subject) {
                $message->to($email)
                ->subject($subject)
                ->cc("accounts@geeckoltd.com", "Geecko Accounts")
                ->replyTo("accounts@geeckoltd.com", "Geecko Accounts")
                ->from("accounts@geeckoltd.com", "Geecko Accounts");
            });
             	 


             }catch(\Exception $e)
              {
              	 dd($e);
              }
        
            
        }





}