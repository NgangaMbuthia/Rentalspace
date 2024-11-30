<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\EmergencyContact;
use Modules\Backend\Entities\TenantsOccupant;
use Modules\Backend\Entities\Possession;
use Modules\Backend\Entities\Student;
use Modules\Backend\Entities\Employer;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\TenantCharges;
use Auth;
use Entrust;
use App\Scopes\MyScope;


class Tenant extends Model
{
   
    protected $guarded= ['id'];


    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
    public function space(){
    	return $this->belongsTo(Space::class);
    }

    public function contact(){
    	return $this->hasOne(EmergencyContact::class,'tenant_id');
    }

    public function occupants(){
    	return $this->hasMany(TenantsOccupant::class,'tenant_id');
    }

    public function items(){
    	return $this->hasMany(Possession::class,'tenant_id');
    }

    public function student(){
    	return $this->hasOne(Student::class,'tenant_id');
    }
    public function employer(){
    	return $this->hasOne(Employer::class,'tenant_id');
    }

    public function charges(){
        return $this->hasMany(TenantCharges::class,'tenant_id');
    }

    public function getAmountPaid($id=null,$space_id=0){
         if($id==null){
            $id=$this->id;
         }
         $tenant=Tenant::where(['space_id'=>$space_id])->first();
         $deposit=TenantCharges::where(['tenant_id'=>$tenant->id,'charge_name'=>'Deposit'])->sum('amount');
         $amount=TenantCharges::where(['tenant_id'=>$tenant->id])->sum('amount');
          return $amount-$deposit;

    }

    public function getBalance($space_id=0,$provider_id=0){
        
         $tenant=Tenant::where(['space_id'=>$space_id])->first();
         $debit=TenantPayment::where(['tenant_id'=>$tenant->id,'space_id'=>$space_id])->sum('debit');
         $credit=TenantPayment::where(['tenant_id'=>$tenant->id,'space_id'=>$space_id])->sum('credit');

          return $amount=$debit-$credit;

    }

     public function getDeposit($space_id=0,$provider_id=0){
        
         $tenant=Tenant::where(['space_id'=>$space_id])->first();

         $amount=TenantCharges::where(['tenant_id'=>$tenant->id,'charge_name'=>'Deposit'])->sum('amount');
        
             
          return $amount;

    }

    public function payments(){

    	   if(Entrust::hasRole("Provider")){
    	   	$provider_id=Auth::User()->getProvider->id;
    	 
    	   	return TenantPayment::where(['provider_id'=>$provider_id,'tenant_id'=>$this->id])
                   ->orderBy('created_at','desc')
    	   	       ->get();

    	   }else{
    	   	return $this->hasMany(TenantPayment::class,'tenant_id');
    	   }
    	
    }

    public function getDebit($id=null){
         $amount=TenantPayment::where(['tenant_id'=>$id])->sum('debit');
          return $amount;

    }
     public function getCredit($id=null){
         $amount=TenantPayment::where(['tenant_id'=>$id])->sum('credit');
          return $amount;

    }

    
}
