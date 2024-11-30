<?php

namespace Modules\Gate\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;

class GateGaurd extends Model
{
	protected $table="gate_guards";
    protected $guarded= ['id'];


    public function user(){
    	return $this->belongsTo(User::class,'user_id');
    }
}
