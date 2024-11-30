<?php
namespace Modules\Backend\Observers;
use Modules\Backend\Entities\Tenant;
use App\Helpers\Helper;
use Auth;
use Modules\Backend\Entities\ContactGroup;
use Modules\Backend\Entities\Contact;
use App\User;
use Modules\Backend\Entities\UtitlityBill;
use Modules\Backend\Entities\Agent;
use App\Messaging;
class UtilityBillObserver{


	 public function creating(UtitlityBill $model)
    {
         //dd($model);
        $water_used_units=doubleval($model->current_w_reading-$model->old_w_reading);
        $electricity_user_units=doubleval($model->current_e_reading-$model->old_e_reading);
        $model->water_used_units=$water_used_units;
        $model->electricity_used_units =$electricity_user_units;
        $provider=Agent::find($model->provider_id);
         $water_rate=($provider)?doubleval($provider->unit_price_water):0;
         $power_rate=($provider)?doubleval($provider->unit_price_electricity):0;
         $model->w_payment_amount =$water_rate*$water_used_units;
         $model->e_payment_amount =$power_rate* $electricity_user_units;
  }

   public function updating(UtitlityBill $model)
   {
    
      $water_used_units=round(doubleval($model->current_w_reading-$model->old_w_reading),3);
        $electricity_user_units=round(doubleval($model->current_e_reading-$model->old_e_reading),3);
        $model->water_used_units=$water_used_units;
        $model->electricity_used_units =$electricity_user_units;
        $provider=Agent::find($model->provider_id);
         $water_rate=($provider)?doubleval($provider->unit_price_water):0;
         $power_rate=($provider)?doubleval($provider->unit_price_electricity):0;
         $model->w_payment_amount =$water_rate*$water_used_units;
         $model->e_payment_amount =$power_rate* $electricity_user_units;
         $model->year=date('Y',strtotime($model->reading_date));
         $model->month=date('M',strtotime($model->reading_date));

          $message=new Messaging();
           $message->receiver_id=$model->tenant_user_id;
           $message->sender_id=Auth::User()->id;
           $message->subject="Utility Bills Updated";
           $message->content="Your utilitity bills have been updated and detailed emailed to you. ";

           $message->flag="notification";
           $message->key=strtoupper(str_random(8));
           $message->save();

         

   }

  



   }