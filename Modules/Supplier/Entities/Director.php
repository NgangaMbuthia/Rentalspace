<?php

namespace Modules\Supplier\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Supplier\Entities\Supplier;

class Director extends Model
{
     protected $guarded = ['id'];

     public function supplier(){
    	return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
