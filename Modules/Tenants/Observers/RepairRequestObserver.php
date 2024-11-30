<?php

namespace Modules\Tenants\Observers;

use App\User;
use Modules\Tenants\Entities\RepairRequest;;
use Modules\Backend\Entities\Space;
use App\Helpers\Helper;
use Auth;

class RepairRequestObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(RepairRequest $model)
    {
        $space=Space::find($model->space_id);
         $property=$space->property;
         $manager=$property->managed_by;
         $email=$property->Manager_email;
         $phone=$property->manager_phone;
          $text_body="Dear ".$manager." ,".Auth::user()->name." has created a new Space Repair Request with the following details :\n  Unit :".$space->title." \n Priority  :" .$model->priorty ."\n Repair Type:".$model->type . "\n Expected Visit Date :".$model->expected_repair_date ."\n Repair  Ticket".$model->repair_ticket;
          $provider_id=$property->provider_id;
          Helper::sendSMS($phone,$text_body,$provider_id,2);
          Helper::sendEmail($email,$text_body,"Repair Request");
           return true;
        
    }

     public function creating(RepairRequest $model)
    {
        
        
        

   }

         public function updating(RepairRequest $model)
    {
        
            
            
              try{

                $user=User::find($model->user_id);
                   $phone=$user->profile->telephone;
                   $name=$user->name;
                   $email=$user->email;

                     try{
                        $text_body="Dear ".$name." Your Repair Request with Ticket Number ".$model->repair_ticket." Has been Closed ";

                      Helper::sendSMS($phone,$text_body);
                      Helper::sendEmail($email,$text_body,"Repair Request Closed");


                     }catch(\Exception $e){
                        Helper::sendEmailToSupport($e);
                     }

                 }catch(\Exception $e){
                 Helper::sendEmailToSupport($e);

                  
               }

                


    }

   

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        //
    }
}