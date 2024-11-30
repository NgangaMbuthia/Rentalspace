<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Tenant;

class EmergencyContact extends Model
{
    protected $guarded= ['id'];


    public function tenant(){
    	return $this->belongsTo(Tenant::class,'tenant_id');
    }
}
