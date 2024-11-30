<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use Modules\Backend\Entities\Property;
class PropertyExpense extends Mymodel
{
    protected $guarded = ['id'];

    public function property(){
    	return $this->belongsTo(Property::class);
    }
}
