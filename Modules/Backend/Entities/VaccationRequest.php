<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Tenant;

class VaccationRequest extends Model
{
    protected $fillable = [];
    protected $table="vaccation_notifications";

     public function tenant(){
    	return $this->belongsTo(Tenant::class,'tenant_id');
    }

}
