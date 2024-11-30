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
use Modules\Backend\Entities\Topup;
use App\Helpers\Helper;
use Entrust;
use Modules\Backend\Entities\Contact;






class Sms
{
	public static $balance;
	
	

	public static function SendSms($data){

		if(Entrust::hasRole("Provider") && Helper::testModule("SMS and Bulk Emails Module",Auth::User()->getProvider->id)){
			$owner_id=Auth::User()->getProvider->id;
			$top=Topup::where(['owner_type'=>'Provider','owner_id'=>$owner_id])->first();
			$balance=$top->active_balance;
			$message=$data['message'];
			$message_size=$intial_message_size=ceil(sizeof($message)/150);
			$type=$data['type'];

			if($type=="both"){
				$message_size=$message_size*2;
			}
			if(isset($data['group_id']) && !empty($data['group_id'])){
				$countact_count=0;
				$contact_list=array();
				foreach($data['group_id'] as $group){
					$group_member_size=Contact::where(['group_id'=>$group])->count();
					$countact_count=$countact_count+$group_member_size;
					$contacts=Contact::where(['group_id'=>$group])->get();
					foreach($contacts as $contact){
						$phone=(isset($contact->mobile))? $contact->mobile:$contact->alt_phone;
						$email=$contact->email;
						$name=$contact->name;
						$contact_list[]=array('name'=>$name,'email'=>$email,'phone'=>$phone);

					}

				}
				
				$total_cost=$countact_count*$message_size;
				if($total_cost<=$balance){
					$balance=$balance-$total_cost;
					$top->active_balance=$balance;
					$top->save();
					if($type=="SMS"){
						Self::sendBulkSms($contact_list,$message,$intial_message_size);

					}else if($type=="EMail"){
						Self::sendBulkEmails($contact_list,$message,$intial_message_size);

					}else{
						Self::sendBulkSms($contact_list,$message,$intial_message_size);
						Self::sendBulkEmails($contact_list,$message,$intial_message_size,false);
					}
					




				}else{
					return false;
				}
				
				
			}



		}

		

		
	}


	public static function sendBulkSms($list,$message2,$size){

		foreach($list as $contact)
		{
			$phone=$contact['phone'];
			Self::send($phone,$message2);
		}
		return true;
		

	}

	public  static function sendBulkEmails($list,$message2,$size,$save_status=false){
		foreach($list as $contact){


			$message=new Message();
			$message->type="Provider";
			$message->type_id=Auth::User()->getProvider->id;
			$message->mesage_size=$size;
			$message->message=$message2;
			$message->delvery_status="DELIVERED";
			$message->phone=$contact['phone'];
			if($save_status!=false){
				$message->save();
			}


			

			
			Self::sendEmail($contact['email'],$message2,"Bulk Emails");
		}
		return true;


	}

	



	public static  function send($phone,$message2)
	{

		$key="H9RhFPF1l2s5gFa77A9SnVtHhzRPp";
		$to=substr($phone, 0,100);
		
		$post = [
		'key' => $key,
		'numbers' => $to,
		'text'   => $message2,
		];

		$ch = curl_init('http://bulk.pictonet.co.ke/api/message/bulk/send');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
		$response = curl_exec($ch);

        // close the connection, release resources used
		curl_close($ch);

        // do anything you want with your response
		$return_message=json_decode($response);
		$success=$return_message->success;
		if($success){
			$response=$return_message->response;
			foreach($response as $respons){
				$message=new Message();
				$message->type="Provider";
				$message->type_id=Auth::User()->getProvider->id;
				$message->mesage_size=$respons->sms_count;
				$message->message=$message2;
				$message->delvery_status=$respons->status;;
				$message->phone=$respons->recipient;
				$message->message_id=$respons->message_id;
				$message->save();
			}

		}
		return true;
	}

	public static function sendEmail($email, $message_body, $subject) 
	{

		try 
		{
			Mail::later(10,'emails.layout', array('mail_body' => $message_body), function ($message) use ($email, $subject) {
				$message->to($email)->subject($subject);
			});
		} 

		catch (Exception $e)
		{
			Log::error($e->getMessage());
		}

	}



}