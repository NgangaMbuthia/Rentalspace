<?php

namespace App\Observers;

use App\User;
use Modules\Backend\Entities\TenantPayment;
use App\Helpers\Helper;
use Modules\Backend\Entities\PropertyTransaction;
use Modules\Backend\Entities\ProviderAccount;
use Modules\Backend\Entities\PropertyAccount;
use Modules\Backend\Entities\ProviderTransaction;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantSummary;
use Modules\Backend\Entities\Property;
class TenantPaymentObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(TenantPayment $model)
    {
               
             

              
                if($model->debit>0)
                {



              $property_id=$model->space->property_id;
              $property=Property::find( $property_id);
               if($property)
               {
                $percentage=$property->agent_commission_percentage;
               }else{
              $percentage=0;
               }
              
                $landload=$model->debit*( (100-$percentage)/100);
                 
                 
              $transaction=new PropertyTransaction();
              $transaction->provider_id=$model->provider_id;
              $transaction->property_id=$property_id;
              $transaction->credit=0;
              $transaction->total_amount=$model->debit;
              $transaction->debit=$landload;
              $transaction->ref_no=$model->reference_number;
              $balance=$model->amount-0;
              $transaction->year=$model->year;
              $transaction->month=$model->month;
              $transaction->tran_date=$model->transaction_date;
              $transaction->Description="Tenant Payment For Unit :".$model->space->number;
              $transaction->method=$model->payment_mode;
              $landloadBalance=$this->getBalance($transaction->property_id);
              $transaction->landloard_balance=$landloadBalance+$landload;
              $account=PropertyAccount::where(['provider_id'=>$model->provider_id,'property_id'=>$property_id,'account_type'=>'Debit'])->first();
              
                if(!$account)
                {
                   $account=new PropertyAccount();
                   $account->provider_id=$model->provider_id;
                   $account->property_id=$property_id;
                   $account->account_type="Debit";
                   $account->save();
                }
              $transaction->account_id=$account->id;
              $transaction->transaction_id=$model->id;
              
              $transaction->save();





               $providerTransaction=new ProviderTransaction();
                $providerTransaction->provider_id=$transaction->provider_id;
                $providerTransaction->amount=doubleval($transaction->debit);
                $providerTransaction->ref_no=$transaction->ref_no;
                $providerTransaction->year=$transaction->year;
                $providerTransaction->month=$transaction->month;
                $providerTransaction->tran_date=$model->transaction_date;
                $paccount=ProviderAccount::where(['provider_id'=>$account->provider_id,'account_type'=>'Debit'])->first();
                $providerTransaction->account_id=$paccount->id;
                $providerTransaction->balance=$paccount->current_balance;
                $providerTransaction->save();
              }

                $this->checkProviderThisMonthsSummary($model);
              
                

                  
                
        }

    public function getBalance($id)
    {
      $model=PropertyTransaction::where(['property_id'=>$id])->latest('id')->first();
       if($model)
       {
        $balance=$model->landloard_balance;
       }else{
        $balance=0;
       }

       return $balance;

    }

     public function creating(TenantPayment $model)
    {
        $model=$model;
        $old_balance=$this->getCurrentBalance($model->tenant_id,$model->space_id);
         if($model->debit==0){

            $new_balance=$old_balance-$model->credit;

         }
         else
         {
              $new_balance=$old_balance+$model->debit;

         }
         $model->balance=$new_balance;
         //Helper::sendEmail("hisanyad@gmail.com","Test isanya","Go IT Right");

        }

   public  function getCurrentBalance($tenant_id,$space_id){

      $model=TenantPayment::where(['tenant_id'=>$tenant_id,'space_id'=>$space_id])->latest('id')->first();

      if($model){
        $balance=$model->balance;
      }else{
        $balance=0;
      }

      return $balance;
    
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

    public function checkProviderThisMonthsSummary($model)
    {
         
           

        return true;
    }

    public function getBalanceBroughtFoward($tenant,$month)
    {

      $month=date('M', strtotime(date('Y-m')." -1 month"));
      $model=TenantSummary::where(['tenant_id'=>$tenant->id,'month'=>$month])->latest('id')->first();
      if($model)
      {
        return ($model->bal_carried_foward>0)?"-".$model->bal_carried_foward:$model->bal_carried_foward;
      }
      return ($model)?$model->balance:0;
    }
}