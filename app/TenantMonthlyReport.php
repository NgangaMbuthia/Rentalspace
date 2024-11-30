<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Space;
class TenantMonthlyReport extends Model
{
	protected $table="tenant_monthly_reports";
    //

   public function space()
   {
   	return $this->belongsTo(Space::class,'space_id');
   }

}
