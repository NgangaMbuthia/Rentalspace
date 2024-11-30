<?php

namespace Modules\Gate\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;

class Incident extends Mymodel
{
    protected $table="gate_incidents";
    protected $guarded = ['id'];
}
