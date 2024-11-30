<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Agent extends Model
{
    protected $guarded = ['id'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

        public function getStats($status=false){
    	if($status==false)
    	{  
          return $this::count();
    	}
    	else
    	{
         return $this::where(['status'=>$status])->count();
    	}
    }
}
