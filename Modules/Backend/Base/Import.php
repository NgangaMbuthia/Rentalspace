<?php

namespace Modules\Backend\Base;

use Illuminate\Database\Eloquent\Model;
use App\User;
use PDF;
use Auth;
use Modules\Backend\Entities\TenantCharges;
use Modules\UserManagement\Entities\Role;
use Modules\UserManagement\Entities\Profile;
use App\Helpers\Helper;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\Deposit;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\InvoiceComponent;
use Modules\Backend\Entities\InvoiceItem;
class Import 
{

	public  static function createExcelUser($result)
	{
      
                 $name=str_random(14);
                   $email=str_random(10)."@jwpip.com";
        
                   $idnumber=str_random(12);;
                   $telephone=$idnumber;
      $user=User::where(['email'=>$email])->first();
       
     if(!$user)
     {
        $user=new User();
        $user->name=$name;
        $user->email=$email;
        $user->password=$idnumber;
        $user->verification_code=str_random(8);
        $user->confirmed_at=date('Y-m-d H:i:s');
        $user->provider="Manual";
        $user->username=$telephone;
        
          if($user->save())
          {
           self::assignTenantRole($user);
            $profile=self::createProfile($user,$idnumber,$telephone);
            //self::sendEmailNotification($user,$idnumber);
            return $user;
          }
     }else{
     	return $user;
     }

}

public static function assignTenantRole($user)
{
	try{
          $test=self::verifyRole($user);
          $user->roles()->attach($test);


         }catch(\Exception $e)
          {
          	
            Helper::sendEmailToSupport($e);
            return false;
          }

}

public static function verifyRole($user)
{
	 $role_id=Role::where(['name'=>'Renter'])->first()->id;
        if($role_id){
           return $role_id;
        }
        else{
            return false;
        }
       

}

public static  function sendEmailNotification($user,$password)
{
   
  $message="Dear ".$user->name.",<br>You have new account created for you for accessing your rental space details by ".auth::user()->getprovider->name." use <br> email: ".$user->email."<br> Password:".$password."<br>  url: http://rentalspace.co.ke";
 
  Helper::sendEmail($user->email,$message,"User Account");
  return true;

}

public static  function createProfile($user,$idnumber,$phone)
{
	$profile_data=array('user_id'=>$user->id,
		                'telephone'=>$phone,
                       
                        'id_number'=>$idnumber,
                        'timezone'=>'Africa/Nairobi',
                        );
	       
     $message="Dear ".$user->name." You have a new Account created for you on qooetu.com for accessing your rental properties.To access your account use \n 
     Email : ".$user->email." \n Password :".$idnumber;
     $telephone=Helper::processNumber($phone);
      Helper::sendSms($telephone,$message);
     $profile=Profile::create($profile_data);
     return $profile;

}

public static  function createTenant($user,$result)
{

  
	 $space_id=$result['spaceid'];
     $rent=doubleval($result['rent']);
     $deposit=doubleval($result['deposit']);
     $baance=doubleval($result['balance']);
      $space=Space::find($space_id);
       

     
      if($space)
      {
        $model=Tenant::where(['user_id'=>$user->id,'space_id'=>$space->id])->first();
         if(!$model)
         {
          $model=New Tenant();
        $model->user_id=$user->id;
        $model->provider_id=$space->property->provider_id;
        $model->monthly_fee=doubleval($rent);
        $model->current_status="Active";
        $model->status="Occupied";
        $model->space_id=$space->id;
         if($model->save())
         {
            self::createTenantCharges($model,$result);
         }

         $space->status="Occupied";
         $space->save();

         }
      	
      	

      	

      }
    

    

}

public static function createTenantCharges($model,$data)
{
   
  
   //create rent
  $mod=new TenantCharges();
  $mod->tenant_id=$model->id;
  $mod->charge_name="Rent";
  $mod->amount=doubleval($data['rent']);
  $mod->effective_from=date('Y-m-d');
  $mod->status="Active";
  $mod->save();
  //create deposit as charge

  $mod=new TenantCharges();
  $mod->tenant_id=$model->id;
  $mod->charge_name="Deposit";
  $mod->amount=doubleval($data['deposit']);
  $mod->effective_from=date('Y-m-d');
  $mod->status="Active";
  $mod->save();

  //create deposit to be refunded later
  self::createDeposit($model,doubleval($data['deposit']));
  //create instance of paymnet for those 
  self::createFirstPayment($model,$data);

   
  


}

public static function createDeposit($tenant,$amount)
{
    $deposit=Deposit::where(['tenant_id'=>$tenant->id])->first();
      if(!$deposit){
           $deposit=new Deposit();
        }
        $deposit->amount=$amount;
        $deposit->status="Paid";
        $deposit->tenant_id=$tenant->id;
        $deposit->save();
}
public static function createInvoice($tenant,$data)
{
   
      $amount=$data['balance'];
         
       if($amount>=1)
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
          $item=self::createInvoiceItems($invoice);


         
          $payment_data=array('provider_id'=>$tenant->provider_id,
                        'space_id'=>$tenant->space_id,
                        'invoice_id'=>$invoice->id,
                        'reference_number'=>str_random(8),
                        'credit'=>$invoice->amount,
                        'debit'=>0,
                        'description'=>"Being Intial Payment ",
                        'payment_mode'=>"System",
                        'type'=>"Intail System Payment",
                        'transaction_date'=>date('Y-m-d'),
                        'system_transaction_number'=>str_random(8),
                        'year'=>date('Y'),
                        'month'=>date('m'),
                        'fee_charges'=>0,
                        'tenant_id'=>$tenant->id,
                        );
    $model=TenantPayment::create($payment_data);
    

       }else{

          $payment_data=array('provider_id'=>$tenant->provider_id,
                        'space_id'=>$tenant->space_id,
                        'invoice_id'=>null,
                        'reference_number'=>str_random(8),
                        'credit'=>0,
                        'debit'=>abs($amount),
                        'description'=>"Being Intial Payment ",
                        'payment_mode'=>"System",
                        'type'=>"Intail System Payment",
                        'transaction_date'=>date('Y-m-d'),
                        'system_transaction_number'=>str_random(8),
                        'year'=>date('Y'),
                        'month'=>date('m'),
                        'fee_charges'=>0,
                        'tenant_id'=>$tenant->id,
                        );
    $model=TenantPayment::create($payment_data);
         
       }
      

}

public static function createFirstPayment($tenant,$data)
{
  $invoice=self::createInvoice($tenant,$data);

}

public  static function createInvoiceItems($invoice)
{
  $rentCode=self::findItemCode("Intial Balance");
        $invoiceitem=new InvoiceItem();
        $invoiceitem->invoice_id=$invoice->id;
        $invoiceitem->code= $rentCode;
        $invoiceitem->name="Intial Balance";
        $invoiceitem->amount=$invoice->amount;
        $invoiceitem->save();
      

}
public static  function findItemCode($item)
  {
    $model=InvoiceComponent::where(['name'=>$item])->first();
    return ($model)?$model->code:null;

  }
       








}