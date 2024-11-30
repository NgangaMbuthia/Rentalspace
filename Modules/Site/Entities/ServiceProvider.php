<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ServiceProvider extends Model
{
    protected $guarded= ['id'];

    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
