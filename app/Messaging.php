<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Messaging extends Model
{
    protected $table="messagings";

    public function sender(){
    	return $this->belongsTo(User::class,'sender_id');
    }
}
