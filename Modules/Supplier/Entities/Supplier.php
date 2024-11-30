<?php

namespace Modules\Supplier\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Supplier\Entities\Director;

class Supplier extends Model
{
     protected $guarded = ['id'];

    public function directors(){
    	return $this->hasMany(Director::class,'supplier_id');
    }

    public function details($id){

    	$model=$this::find($id);
    	 

    	 return $model;
    }
}
