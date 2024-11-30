<?php
namespace Modules\Backend\Observers;
use Modules\Backend\Entities\Tenant;
use App\Helpers\Helper;
use Auth;
use Modules\Backend\Entities\ContactGroup;
use Modules\Backend\Entities\Contact;
use App\User;

class TenantObserver{


	 public function created(Tenant $model)
    {
         $user=$model->user;
         $name=$user->name;
         $email=$user->email;
         $mobile=$user->profile->telephone;
         $mobile=str_replace('-', '', $mobile);
         $property=$model->space->property;
         $group_id=$this->getGroup($property);
           try{
           	$contact=new Contact();
            $contact->group_id=$group_id;
            $contact->name=ucfirst($name);
            $contact->email=$email;
            $contact->mobile=Helper::processNumber($mobile);
            $contact->save();
             
            return true;
            }catch(\Exception $e)
            {
               Helper::sendEmailToSupport($e);
               return false;
            }
            
                     
     }

     public function getGroup($property){
     	$group_name=$property->title;
     	$owner_id=$property->provider_id;
     	 $model=ContactGroup::where(['group_name'=>$group_name,'owner_id'=>$owner_id,'owner_type'=>'Provider'])->first();
     	  if(!$model){
     	  	$model=new ContactGroup();
     	  	$model->group_name=$group_name;
     	  	$model->owner_id=$owner_id;
     	  	$model->owner_type="Provider";
     	  	$model->save();
     	  	return $model->id;
     	  }else{
     	  	return $model->id;
     	  }

     }



   }