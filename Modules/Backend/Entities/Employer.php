<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Tenant;

class Employer extends Model
{
    protected $fillable = [];
    protected $table="employed_tenants";

     public function tenant(){
    	return $this->belongsTo(Tenant::class,'tenant_id');
    }

    
}
