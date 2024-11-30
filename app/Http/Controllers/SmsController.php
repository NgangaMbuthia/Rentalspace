<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Entrust;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\Amentity;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Space;
use Carbon;
use App\ProviderModule;
use Modules\Backend\Entities\Invoice;
use App\Helpers\TestClass;
use App\User;
use Modules\Gate\Entities\GateVisitor;
use Modules\Gate\Entities\GateGaurd;
use Modules\ServiceProviders\Entities\JobRequest;
use Modules\ServiceProviders\Http\Middleware\ApprovalMiddle;
use Modules\Gate\Entities\Incident;
use Modules\Tenants\Entities\RepairRequest;
use Modules\Backend\Entities\VaccationRequest;
use Modules\Hotels\Entities\Hotel;
use Auth;
use Modules\Hotels\Entities\RoomType;
use Modules\Hotels\Entities\BedType;
use Modules\Hotels\Entities\SupplierAmenty;
use Modules\Hotels\Entities\HotelRoom;
use App\Helpers\InvoiceSender;
use  App\Helpers\Helper;
use Session;
use App\Messaging;
use App\Http\Middleware\AccountSetUp;

class SmsController extends Controller
{
    //
      public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(AccountSetUp::class);

    }


    public function saveSmsOption(Request $request)
    {
    	 try{
    	$user=\Auth::user();
        $model=Agent::where(['user_id'=>$user->id])->first();
         $data=$request->all();
         $model->sms_provider=strtoupper($data['sms_provider']);
         $model->sms_sender_name=$data['sms_sender_name'];
         $model->sms_api_url=$data['sms_api_url'];
         $model->passkey=$data['passkey'];
         $model->has_api="Yes";
         $model->save();
         $user=$model->user;
          if($user)
          {
          	$message="Dear ".$user->name." ,You SMS Configurations has been updated successfully at ".date("Y-M-dS H:i:s");

          	  Helper::createNotification($user,$message,true,"Sms Configurations Updated Successfully");
          }
          Session::flash("success_msg","Sms Configurations updated successfully");
          }catch(\Exception $e)
    	  {

    	  	Helper::sendEmailToSupport($e);
    	  	return false;
    	  }
    	  return redirect()->back();
         }


         public function saveEmailOption(Request $request)
         {

    	 try{
    	$user=\Auth::user();
        $model=Agent::where(['user_id'=>$user->id])->first();
         $data=$request->all();
         $model->email=$data['email'];
         $model->altenative_email=$data['altenative_email'];
         $model->reply_email=$data['reply_email'];
         $model->save();
         $user=$model->user;
          if($user)
          {
          	$message="Dear ".$user->name." ,Your Email Configurations have been updated successfully at ".date("Y-M-dS H:i:s");

          	  Helper::createNotification($user,$message,true,"Email Configurations Updated Successfully");
          }
          Session::flash("success_msg","Email Configurations updated successfully");
          }catch(\Exception $e)
    	  { Helper::sendEmailToSupport($e);
    	  	return false;
    	  }
    	  return redirect()->back();

         }

         public function invoiceOption(Request $request)
         {
         	try{
    	$user=\Auth::user();
        $model=Agent::where(['user_id'=>$user->id])->first();
         $data=$request->all();
         $model->invoice_send_day=$data['invoice_send_day'];
         $model->invoice_send_time=date('H:i:s',strtotime($data['invoice_send_time']));
         $model->encrypt_invoice=$data['encrypt_invoice'];
         $model->method=$data['method'];
         $model->save();
         $user=$model->user;
          if($user)
          {
          	//ALTER TABLE `agents` ADD `invoice_send_day` INT(12) NULL AFTER `altenative_email`, ADD `invoice_send_time` VARCHAR(254) NULL AFTER `invoice_send_day`, ADD `encrypt_invoice` VARCHAR(122) NULL AFTER `invoice_send_time`, ADD `method` VARCHAR(122) NULL AFTER `encrypt_invoice`;
          	$message="Dear ".$user->name." ,Your Invoice Configurations have been updated successfully at ".date("Y-M-dS H:i:s");

          	  Helper::createNotification($user,$message,true,"Invoice Configurations Updated Successfully");
          }
          Session::flash("success_msg","Invoice Configurations updated successfully");
          }catch(\Exception $e)
    	  {
            
    	  	Helper::sendEmailToSupport($e);
    	  	return false;
    	  }
    	  return redirect()->back();

         }


         public function utilitySettings(Request $request)
         {
              try{
      $user=\Auth::user();
        $model=Agent::where(['user_id'=>$user->id])->first();
         $data=$request->all();
         $model->unit_price_water=doubleval($data['unit_price_water']);
         $model->unit_price_electricity=doubleval($data['unit_price_electricity']);
         $model->gabbage_collection=doubleval($data['gabbage_collection']);
          $model->save();
         $user=$model->user;
          if($user)
          {
            
            $message="Dear ".$user->name." ,Your Utility Configurations have been updated successfully at ".date("Y-M-dS H:i:s");

              Helper::createNotification($user,$message,true,"Utility Configurations Updated Successfully");
          }
          Session::flash("success_msg","Utility Configurations updated successfully");
          }catch(\Exception $e)
        {
            
          Helper::sendEmailToSupport($e);
          return false;
        }
        return redirect()->back();


         }





}
