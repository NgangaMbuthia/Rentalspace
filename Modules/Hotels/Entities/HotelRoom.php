<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use Modules\Hotels\Entities\HotelRoomGallery;
class HotelRoom extends Mymodel
{
     protected $table="hotel_rooms";
     protected $guarded=['id'];

     public function images(){
    	return $this->hasMany(HotelGallery::class,'hotel_id');
    }
}
