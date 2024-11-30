<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
class PropertyTransaction extends Mymodel
{  protected $table="property_transactions";
    protected $guarded = ['id'];
}
