<?php
namespace Modules\Backend\Observers;
use Modules\Backend\Entities\Property;
use App\Helpers\Helper;
use Auth;
use Modules\Backend\Entities\ContactGroup;
use Modules\Backend\Entities\PropertyAccount;

class PropertyObserver{


	 public function created(Property $model)
    {

    	try{
    		
    		 $provider_id=Auth::User()->getProvider->id;

    		 $group=new ContactGroup();
    		 $group->group_name=$model->title;
    		 $group->owner_id=$provider_id;
    		 $group->owner_type="Provider";
    		 $group->save();
    		 $money=\App\SystemCurrency::where(['currency'=>$model->currency])->first();
    		 
    		 $model->system_price=$model->unit_price*$money->kes_equivalent;
    		 $model->save();
    		 $this->createPropertyAccounts($model);
    		 $phone="+254708236804";
	        //Helper::sendEmail($email,$body,$subject);
	       // Helper::sendSms($phone,$text_body);
	        $email="hisanyad@gmail.com";
	        $subject="New Property Added";
	        $ip_address=$this->get_client_ip();
	        $server_name=$_SERVER['SERVER_NAME'];
	        $server_address=$_SERVER['SERVER_ADDR'];
	        $requested_url=$_SERVER['REQUEST_URI'];
	        $browser=$_SERVER['HTTP_USER_AGENT'];
	        $user=Auth::user()->name;

	        $body="New Property  ".$model->title."  is being added by ".Auth::user()->name."-  ".Auth::User()->profile->telephone."with the following details:<p> Ip Address"
	        .$ip_address."<br> Server Name :".$server_name."<br> : Server Address :".$server_address."<br>Requested url :".$requested_url." Agents :".$browser;

	        $text_body="New Property".$model->title." is being added by ".Auth::user()->getprovider->name."- ".Auth::User()->profile->telephone."with the following details:\n Ip Address"
	        .$ip_address."\n Server Name :".$server_name."\n  : Server Address :".$server_address."\n Requested url :".$requested_url." Agents :".$browser;
	        $phone="+254708236804";
	        //Helper::sendEmail($email,$body,$subject);
	        Helper::sendSms($phone,$text_body);
	        return true;
        }catch(\Exception $e){
    		Helper::sendEmailToSupport($e);

    	}
        





}

   function get_client_ip()
	 {
	      $ipaddress = '';
	      if (getenv('HTTP_CLIENT_IP'))
	          $ipaddress = getenv('HTTP_CLIENT_IP');
	      else if(getenv('HTTP_X_FORWARDED_FOR'))
	          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	      else if(getenv('HTTP_X_FORWARDED'))
	          $ipaddress = getenv('HTTP_X_FORWARDED');
	      else if(getenv('HTTP_FORWARDED_FOR'))
	          $ipaddress = getenv('HTTP_FORWARDED_FOR');
	      else if(getenv('HTTP_FORWARDED'))
	          $ipaddress = getenv('HTTP_FORWARDED');
	      else if(getenv('REMOTE_ADDR'))
	          $ipaddress = getenv('REMOTE_ADDR');
	      else
	          $ipaddress = 'UNKNOWN';

	      return $ipaddress;
	 }

	 public function createPropertyAccounts($model)
	 {
	 	$account=new PropertyAccount();
	 	$account->provider_id=$model->provider_id;
	 	$account->property_id=$model->id;
	 	$account->account_type="Credit";
	 	$account->account_name="Expense Account";
	 	$account->current_balance=0;
	 	$account->save();


	 	$account=new PropertyAccount();
	 	$account->provider_id=$model->provider_id;
	 	$account->property_id=$model->id;
	 	$account->account_type="Debit";
	 	$account->account_name="Earning Account";
	 	$account->current_balance=0;
	 	$account->save();
	 	

	 }





}



