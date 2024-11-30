<?php

namespace Modules\Hotels\Entities;

use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    protected $table="hotel_bed_type";
   protected $guarded=['id'];

}
