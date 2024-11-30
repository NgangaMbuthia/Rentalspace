<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
class HotelType extends Mymodel
{
     protected $guarded=['id'];

     protected $rules = array(
     'name'=>'required|unique:hotel_service_list',
     'category'=>'required',
    );


     
   protected  $messages = [
        'name.required' => 'Fill Service Name',
        'name.unique'=>'Service Name already taken'
    ];
}
