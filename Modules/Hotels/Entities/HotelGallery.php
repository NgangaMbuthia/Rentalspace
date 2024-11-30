<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use Modules\Hotels\Entities\Hotel;

class HotelGallery extends Mymodel
{
   protected $table="hotel_gallery";
     protected $guarded=['id'];


     public function hotel(){
     	return $this->belongsTo(Hotel::class,'hotel_id');
     }
}
