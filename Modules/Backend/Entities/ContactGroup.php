<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    protected $table="bulk_groups";
     protected $guarded= ['id'];
}
