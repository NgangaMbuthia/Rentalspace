<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use Modules\Backend\Entities\Space;
use Auth;
class UtitlityBill extends Mymodel
{
	protected $table="utility_bills";
    protected $guarded = ['id'];

    public function space(){
    	return $this->belongsTo(Space::class);
    }

    public function getWaterAmount($month,$year)
    {
    	$user_id=auth::user()->id;
    	$sum=$this->where(['tenant_user_id'=>$user_id,'month'=>$month,'year'=>$year])->sum('w_payment_amount');
    	 return number_format($sum,2);

    }

    public function getPowerAmount($month,$year)
    {
    	$user_id=auth::user()->id;
    	$sum=$this->where(['tenant_user_id'=>$user_id,'month'=>$month,'year'=>$year])->sum('e_payment_amount');
    	 return number_format($sum,2);

    }

    public function getSumAmount($month,$year)
    {
    	$user_id=auth::user()->id;
    	$sum1=$this->where(['tenant_user_id'=>$user_id,'month'=>$month,'year'=>$year])->sum('e_payment_amount');
    	$sum2=$this->where(['tenant_user_id'=>$user_id,'month'=>$month,'year'=>$year])->sum('w_payment_amount');
    	 return number_format(($sum1+$sum2),2);

    }
}
