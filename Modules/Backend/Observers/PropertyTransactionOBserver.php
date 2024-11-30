<?php
namespace Modules\Backend\Observers;
use Modules\Backend\Entities\Property;
use App\Helpers\Helper;
use Auth;
use Modules\Backend\Entities\ContactGroup;
use Modules\Backend\Entities\PropertyTransaction;
use Modules\Backend\Entities\PropertyAccount;
use Modules\Backend\Entities\ProviderAccount;
use Modules\Backend\Entities\ProviderTransaction;

class PropertyTransactionOBserver{


 public function creating(PropertyTransaction $model)
 {

       
 	 $transaction=PropertyTransaction::where(['provider_id'=>$model->provider_id,'property_id'=>$model->property_id])->latest('id')->first();
       if($transaction)
       {
        $old_balance=$transaction->balance;
       }else{
        $old_balance=0;
       }
       $balance=$old_balance+$model->debit-$model->credit;



    	$model->balance=$balance;

    	
    

 	  
 }



	 public function created(PropertyTransaction $model)
    {
          
    	$account=PropertyAccount::find($model->account_id);
    	 if($account)
    	 {  $credit=$model->credit;
    	 	$debit=$model->debit;
    	 	$balance=$debit-$credit;
    	 	$old_banace=$account->current_balance;
    	 	$new_balance=$old_banace+$balance;
    	 	$account->current_balance=$new_balance;
    	 	$account->save();
    	 	 if($account)
             {
                 //dd($model);

                  $paccount=ProviderAccount::where(['provider_id'=>$account->provider_id,'account_type'=>$account->account_type])->first();
            $new_balance=$balance;
                 $old_banace=$paccount->current_balance;
                 $new_balance=$old_banace+$balance;
                 $paccount->current_balance=$new_balance;
                 $paccount->save();
                 



                $providerTransaction=new ProviderTransaction();
                $providerTransaction->provider_id=$model->provider_id;
                $providerTransaction->amount=doubleval($model->debit);
                $providerTransaction->ref_no=$model->ref_no;
                $providerTransaction->year=$model->year;
                $providerTransaction->month=$model->month;
                $providerTransaction->tran_date=$model->tran_date;
                $paccount=ProviderAccount::where(['provider_id'=>$model->provider_id,'account_type'=>'Credit'])->first();
                
                $providerTransaction->account_id=$paccount->id;
                $providerTransaction->balance=$paccount->current_balance;
                $providerTransaction->save();
             ;



            

             	

             }
    	 }

       }

  



}



