<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [];

    public function space()
    {
    	return $this->belongsTo(Space::class,'space_id');
    }
}
