<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $guarded = ['id'];
    protected $table="uploads";



   /* public function setExtensionAttribute($value)
    {
    	$this->attributes['user_id']=\Auth::user()->id;
    }*/
}
