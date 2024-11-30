<?php
namespace Modules\Backend\Observers;
use Modules\Backend\Entities\Agent;
use App\Helpers\Helper;
use Auth;
use Modules\Backend\Entities\ContactGroup;
use Modules\Backend\Entities\ProviderAccount;

class ProviderObserver{


	 public function created(Agent $model)
    {

    	try{
    		   
    		
    		$account=new ProviderAccount();
    		$account->provider_id=$model->id;
    		$account->account_type="Credit";
    		$account->account_name="Expense Account";
    		$account->current_balance=0;
    		$account->save();


    		$account=new ProviderAccount();
    		$account->provider_id=$model->id;
    		$account->account_type="Debit";
    		$account->account_name="Earnings Account";
    		$account->current_balance=0;
    		$account->save();
            $phone="+254708236804";
    		 $email="hisanyad@gmail.com";
    		 $body="Dear Sir,A new Provider has been added to your ".config('app.name')." application.-".$model->name." with phone ".$model->telephone." email ".$model->email." .Kindly confirm acknowledgement";
    		 $subject="New Provider";
	        Helper::sendEmail($email,$body,$subject);
	        return true;
	       

        }catch(\Exception $e){
    		//Helper::sendEmailToSupport($e);

    	}
        





}

   



}



