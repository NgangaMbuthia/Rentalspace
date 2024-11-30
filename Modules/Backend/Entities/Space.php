<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Property;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\SpaceTemplate;


class Space extends Model
{
    protected $guarded = ['id'];

    public function property(){
    	return $this->belongsTo(Property::class);
    }

    public function tenants(){
    	return $this->hasMany(Tenant::class,'space_id');
    }

    public  function getAmount($id){
    	 $debit=TenantPayment::where(['space_id'=>$id])->sum('debit');
    	  $credit=TenantPayment::where(['space_id'=>$id])->sum('credit');
          return $amount=$debit-$credit;

    }

    public function template(){
        return $this->belongsTo(SpaceTemplate::class,'template_id');
    }




}
