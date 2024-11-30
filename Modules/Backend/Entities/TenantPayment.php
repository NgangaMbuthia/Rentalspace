<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\Invoice;
use Auth;
use Modules\Backend\Entities\Space;

class TenantPayment extends Model
{
    protected $guarded = ['id'];
    protected $table="tenant_payments";


    public function tenant(){
    	return $this->belongsTo(Tenant::class);
    }


    public function getYearPerformance($year=false,$property_id){

		if($year==false){
			$model=$this->join('spaces','spaces.id','tenant_payments.space_id')
		    	       ->where(['spaces.property_id'=>$property_id])
		    	       ->sum('debit');
             }
			else{
				$model=$this->join('spaces','spaces.id','tenant_payments.space_id')
			    	       ->where(['spaces.property_id'=>$property_id])
			    	       ->whereYear('tenant_payments.created_at',$year)
			    	       ->sum('debit');
			    }
    	
    	       return $model;

    }

    public function invoice(){
    	return $this->belongsTo(Invoice::class,'invoice_id');
    }


     public function statistics($property=false,$year=false,$month=false){
        $id=\Auth::User()->getProvider->id;
         if($property==false  && $year==false && $month==false){
            return $this::count();
         }

         if($property==false  &&  $month==false){
            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('tenant_payments.provider_id',$id)->whereYear('tenant_payments.created_at',$year)
               ->where('tenant_payments.type','Rent')
                ->sum('debit');
         }
         else if($month==false){

         return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('spaces.property_id',$property->id)->whereYear('tenant_payments.created_at',$year)
                ->where('tenant_payments.provider_id',$id)
                ->where('tenant_payments.type','Rent')
                ->sum('debit');

         }elseif ($property==false) {

            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('provider_id',$id)->whereYear('tenant_payments.created_at',$year)
                ->whereMonth('tenant_payments.created_at',$month)
                ->where('tenant_payments.type','Rent')
                 ->sum('debit');
             
         }

         else{
               $id=\Auth::User()->getProvider->id;
          //return $property->id;
            return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('spaces.property_id',$property->id)->whereYear('tenant_payments.created_at',$year)
                ->where('tenant_payments.provider_id',$id)
                ->where('tenant_payments.type','Rent')
                ->whereMonth('tenant_payments.created_at',$month)->sum('debit');
         }


    }


    public function propertystatistics($property=false,$year=false,$month=false){


         $id=\Auth::User()->getProvider->id;
         if($property==false  && $year==false && $month==false){
            return $this::count();
         }

         if($property==false  &&  $month==false){
            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('tenant_payments.provider_id',$id)->whereYear('tenant_payments.created_at',$year)
               ->where('tenant_payments.type','Rent')
                ->sum('debit');
         }
         else if($month==false &&  $year==false){
            

         return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('spaces.property_id',$property->id)
                ->where('tenant_payments.provider_id',$id)
                ->where('tenant_payments.type','Rent')
                ->sum('debit');

         }

          else if($year==false ){
           return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('spaces.property_id',$property->id)
                 ->whereMonth('tenant_payments.created_at',$month)
                ->where('tenant_payments.provider_id',$id)
                ->where('tenant_payments.type','Rent')
                ->sum('debit');

         }

          else if($month==false ){
           return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('spaces.property_id',$property->id)
                 ->whereYear('tenant_payments.created_at',$year)
                ->where('tenant_payments.provider_id',$id)
                ->where('tenant_payments.type','Rent')
                ->sum('debit');

         }


         elseif ($property==false) {

            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('provider_id',$id)->whereYear('tenant_payments.created_at',$year)
                ->whereMonth('tenant_payments.created_at',$month)
                ->where('tenant_payments.type','Rent')
                 ->sum('debit');
             
         }

         else{
               $id=\Auth::User()->getProvider->id;

          //return $property->id;
            return $this->join('spaces','spaces.id','=','tenant_payments.space_id')->where('spaces.property_id',$property->id)->whereYear('tenant_payments.created_at',$year)
                ->where('tenant_payments.provider_id',$id)
                ->where('tenant_payments.type','Rent')
                ->whereMonth('tenant_payments.created_at',$month)->sum('debit');
         }

    }


         public function space(){
        return $this->belongsTo(Space::class);
    }






}
