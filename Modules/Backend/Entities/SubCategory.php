<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\Property;

class SubCategory extends Model
{
    protected $guarded= ['id'];

    public function category(){
    	return $this->belongsTo(Category::class,'category_id');
    }

    public function property(){
    	return $this->hasMany(Property::class,'category_id');
    }
}
