<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
   protected $table="topups";
    protected $guarded = ['id'];
}
