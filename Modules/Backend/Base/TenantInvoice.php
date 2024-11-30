<?php

namespace Modules\Backend\Base;

use Illuminate\Database\Eloquent\Model;
use App\User;
use PDF;
use Auth;
use Modules\Backend\Entities\TenantCharges;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\TenantPayment;
use App\TenantMonthlyReport;
use Modules\Backend\Entities\TenantSummary;
class TenantInvoice 
{
    public static function Create($tenant,$amount)
    {

    	$invoice=new Invoice();
          $invoice->provider_id=$tenant->provider_id;
          $invoice->issued_to=$tenant->user_id;
          $invoice->space_id=$tenant->space_id;
          $invoice->issue_date=date('Y-m-d');
          $invoice->amount=$amount;
          $invoice->status="Pending";
          $invoice->type="Monthly Invoice";
          $invoice->due_date=date('Y-m-d', strtotime($invoice->issue_date . "+7 days"));
          $invoice->invoice_number=substr(number_format(time() * rand(),0,'',''),0,6);
          $invoice->save(); 
           
            if($invoice)
            {
              $payment=new TenantPayment();
		      $payment->debit=0;
		      $payment->payment_mode="Cash";
		      $payment->credit=$invoice->amount;
		      $payment->space_id=$invoice->space_id;
		      $payment->invoice_id=$invoice->id;
		      $payment->provider_id=$invoice->provider_id;
		      $payment->tenant_id=$tenant->id;
		      $payment->year=date("Y",strtotime($invoice->issue_date));
		      $payment->type="Rent";
		      $payment->transaction_date=date('Y-m-d',strtotime($invoice->issue_date));
		      $payment->system_transaction_number=strtoupper(str_random(8));
		      $payment->month=date('m',strtotime($invoice->issue_date));
		      $payment->reference_number=$invoice->invoice_number."/". str_random(4);
		      $payment->description="Request For Rent Payment for Invoice ".$invoice->invoice_number;
             $payment->save();
          }

          self::createSummary($tenant,$invoice);


     }

     public static function createSummary($tenant,$invoice)
     {
       $payment=TenantPayment::where(['space_id'=>$tenant->space_id,'month'=>date('M'),'year'=>date('Y')])->latest('id')->first();
         if(!$payment)
         {
            $payment=new TenantMonthlyReport();
         }
     
       $payment->tenant_id=$tenant->id;
       $payment->space_id=$invoice->space_id;
       $payment->month=date('M');
       $payment->year=date('Y');
       $payment->pre_balance=0;
       $payment->invoice_amount=$invoice->amount;
       $payment->new_balance=$payment->pre_balance+$payment->invoice_amount;
       $payment->amount_paid=0;
       $payment->balance=$payment->invoice_amount;
       $payment->month_code=date('Ym',strtotime($invoice->issue_date));
       $payment->save();


               $tenantsummary=TenantSummary::where(['space_id'=>$invoice->space_id,'month'=>$payment->month,'year'=>$payment->year])->latest('id')->first();
                 if(!$tenantsummary)
                 {
                  $tenantsummary=new TenantSummary();
                 }
               
               $tenantsummary->provider_id=$tenant->provider_id;
               $tenantsummary->property_id=$tenant->property_id;
               $tenantsummary->user_id=$invoice->issued_to;
               $tenantsummary->space_id=$invoice->space_id;
               $tenantsummary->tenant_id=$tenant->id;
               $tenantsummary->month=$payment->month;
               $tenantsummary->year=$payment->year;
               $tenantsummary->bal_brought_forward=$payment->pre_balance;
               
                $tenantsummary->amount_paid=0;
               $tenantsummary->invoice_amount=$payment->invoice_amount;
               $tenantsummary->outstanding_balance=$tenantsummary->invoice_amount;
               $tenantsummary->new_balance=$tenantsummary->outstanding_balance-$tenantsummary->amount_paid;
               $tenantsummary->bal_carried_foward=$tenantsummary->invoice_amount;
                if($tenantsummary->bal_carried_foward==0)
                {
                  $tenantsummary->remarks="No Balance";
                }
                else if($tenantsummary->bal_carried_foward<0)
                {
                  $tenantsummary->remarks="Has Overpaid";
                }else{
                  $tenantsummary->remarks="Has Balance";
                }
                $tenantsummary->save();
                 return true;
                



       

     }

   }