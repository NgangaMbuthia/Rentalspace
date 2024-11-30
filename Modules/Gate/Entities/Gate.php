<?php

namespace Modules\Gate\Entities;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{
    
    protected $table="gate_gates";
    protected $guarded = ['id'];
}
