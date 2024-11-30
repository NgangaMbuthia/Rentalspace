<?php

namespace App\Observers;

use App\User;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantSummary;

class InvoiceObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(Invoice $model)
    {

   
        $model->balance=$model->amount;
         
        $tenant=Tenant::where(['user_id'=>$model->issued_to,'space_id'=>$model->space_id])->latest('id')->first();

          $summary=TenantSummary::where(['user_id'=>$model->issued_to,'space_id'=>$tenant->space_id,'tenant_id'=>$tenant->id,'month'=>date("M"),'Year'=>date("Y")])->first();
              /*if(!$summary)
              {
                    $summary=new TenantSummary();
                    $summary->user_id=$model->issued_to;
                    $summary->tenant_id=$tenant->id;
                    $summary->provider_id=$tenant->provider_id;
                    $summary->property_id =$tenant->space->property_id;
                    $summary->space_id=$tenant->space->id;
                    $summary->month=date('M');
                    $summary->year=date('Y');
                    $summary->invoice_amount=$model->amount;

                     $bal_forward=$this->getBalanceBroughtFoward($tenant,$summary->month);
                      $summary->bal_brought_forward=(doubleval($bal_forward)*-1);
                    $summary->outstanding_balance=doubleval($summary->bal_brought_forward-$summary->invoice_amount );
                         if($model->amount>0)
                         {
                        $summary->bal_carried_foward=doubleval($model->outstanding_balance+$model->amount);
                        }else{
                          $summary->bal_carried_foward=doubleval($model->outstanding_balance-$model->amount);
                        }
                    $summary->save();


              }else{
                   
                 $summary->invoice_amount=$summary->invoice_amount+$model->amount;
                 $summary->outstanding_balance=($summary->outstanding_balance+$model->amount)-$summary->amount_paid;
                 if($summary->outstanding_balance>0)
                 {
                    $summary->bal_carried_foward="-".$summary->outstanding_balance;
                 }
                 else if($summary->outstanding_balance==0)
                 {
                     $summary->bal_carried_foward=0;
                 }
                 else{
                    $summary->bal_carried_foward=$summary->outstanding_balance;
                 }
                  $summary->save();

              


              }*/
               
          
           




        
    }

    

         public function updating(Invoice $model)
    {
        
        $status=$model->status;
         if($status=="Cancelled"){
             
             $tenant=Tenant::where('user_id',$model->issued_to)->first();
            
            $payment=new TenantPayment();
            $payment->debit=$model->amount;
            $payment->payment_mode="Others";
            $payment->credit=0;
            $payment->space_id=$model->space_id;
            $payment->invoice_id=$model->id;
            $payment->provider_id=$model->provider_id;
            $payment->tenant_id=$tenant->id;
            $payment->year=date("Y");
            $payment->type="Invoice Cancellation";
            $payment->transaction_date=date('Y-m-d');
            $payment->system_transaction_number=str_random(8);
            $payment->month=date('m');
            $payment->reference_number=$model->invoice_number."/". str_random(4);
            $payment->description="Refund for Cancellation of Invoice Number".$model->invoice_number;
            $payment->save();
            


             

            
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