<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
class RoomType extends Mymodel
{
    protected $table="hotel_room_type";
   protected $guarded=['id'];


}
