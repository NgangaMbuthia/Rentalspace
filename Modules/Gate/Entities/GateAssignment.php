<?php

namespace Modules\Gate\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Gate\Entities\GateGaurd;

class GateAssignment extends Model
{
   protected $table="gate_gateassignments";
    protected $guarded= ['id'];


    public function guards(){
    	return $this->belongsTo(GateGaurd::class,'guard_id');

    }
}
