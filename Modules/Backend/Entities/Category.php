<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Property;

class Category extends Model
{
    protected $guarded = ['id'];

    public function property(){
    	return $this->hasMany(Property::class,'category_id');
    }
}
