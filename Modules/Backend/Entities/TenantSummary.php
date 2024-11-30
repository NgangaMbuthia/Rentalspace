<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Space;
class TenantSummary extends Model
{
    protected $fillable = [];
    
         public function space(){
        return $this->belongsTo(Space::class);
    }

    public function getInvoiced($Property_id)
    {
    	$amount=$this->where(['property_id'=>$Property_id,'month'=>date('M'),'year'=>date('Y')])->sum('invoice_amount');

    	return number_format($amount);

    }


    public function getPaid($Property_id)
    {
    	$amount=$this->where(['property_id'=>$Property_id,'month'=>date('M'),'year'=>date('Y')])->sum('amount_paid');

    	return number_format($amount);

    }
     public function getBalance($Property_id)
    {
    	$amount=(str_replace(",", "", $this->getInvoiced($Property_id))-str_replace(",","",$this->getPaid($Property_id)));

    	return number_format($amount);

    }

    public function getSpaceFree($id)
    {
    	$count=Space::where(['property_id'=>$id])->whereIn('status',array('Free','Vacant'))->count();
    	return $count;

    }
    public function getOccipiedFree($id)
    {
    	$count=Space::where(['status'=>'Occupied','property_id'=>$id])->count();
    	return $count;

    }
}
