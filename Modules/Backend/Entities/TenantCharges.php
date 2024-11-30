<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class TenantCharges extends Model
{
    protected $guearded = ['id'];
    protected $table="tenant_charges";
}
