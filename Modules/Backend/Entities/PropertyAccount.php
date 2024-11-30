<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
class PropertyAccount extends Mymodel
{
	 protected $table="properties_accounts";
    protected $guarded = ['id'];
}
