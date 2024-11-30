<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Mymodel;

class Supplier extends Mymodel
{
	protected $table="service_suppliers";
   protected $guarded=['id'];

   public function user(){
   	return $this->belongsTo(User::class,'user_id');
   }
}
