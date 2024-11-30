<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
class HotelRoomGallery extends Mymodel
{
	
   protected $table="room_gallery";
     protected $guarded=['id'];
}
