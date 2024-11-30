<?php

namespace App\Observers;

use App\User;
use Modules\Backend\Entities\Invoice;
use Modules\Backend\Entities\TenantPayment;
use Modules\Backend\Entities\Tenant;
use App\ProviderModule;
use App\SystemModule;

class ProviderModuleObserver
{

	 public function created(ProviderModule $model)
    {
    	 $module=SystemModule::find($model->module_id);
    	  $number=$module->no_of_clients;
    	  $number=$number+1;
    	  $module->no_of_clients=$number;
    	  $module->save();

      }


}