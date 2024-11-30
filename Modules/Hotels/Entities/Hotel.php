<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use Modules\Hotels\Entities\HotelAmentitities;
use Modules\Hotels\Entities\HotelGallery;

class Hotel extends Mymodel
{
    protected $guarded=['id'];


    public function amentities(){
     return $this->hasMany(HotelAmentitities::class,'hotel_id');
    }
    public function images(){
    	return $this->hasMany(HotelGallery::class,'hotel_id');
    }
}
