<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Tenant;

class Student extends Model
{
    protected $fillable = [];

    public function tenant(){
    	return $this->belongsTo(Tenant::class,'tenant_id');
    }
}
