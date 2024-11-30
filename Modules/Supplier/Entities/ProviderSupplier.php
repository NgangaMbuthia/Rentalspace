<?php

namespace Modules\Supplier\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Supplier\Entities\Supplier;

class ProviderSupplier extends Model
{
    protected $fillable = [];

     public function supplier(){
    	return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
