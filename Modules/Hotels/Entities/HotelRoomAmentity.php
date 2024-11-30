<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
class HotelRoomAmentity extends Mymodel
{
     protected $table="room_amentities";
     protected $guarded=['id'];
}
