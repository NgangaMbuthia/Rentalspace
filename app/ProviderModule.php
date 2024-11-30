<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SystemModule;

class ProviderModule extends Model
{
    //

    public function module(){
    	return $this->belongsTo(SystemModule::class,'module_id');
    }
}
