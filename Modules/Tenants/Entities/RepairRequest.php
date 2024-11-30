<?php

namespace Modules\Tenants\Entities;

use Illuminate\Database\Eloquent\Model;

class RepairRequest extends Model
{
    protected $guarded = ['id'];

    protected $table="repair_requests";
}
