<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use Modules\Hotels\Entities\SupplierAmenty;
class HotelAmentitities extends Mymodel
{
	  protected $table="hotel_amentities";
     protected $guarded=['id'];

     public function amentity(){
     	return $this->belongsTo(SupplierAmenty::class,'amentity_id');
     }
}
