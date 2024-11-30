<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Agent;
use App\Scopes\MyScope;
use Modules\Backend\Entities\InvoiceItem;


class Invoice extends Model
{
    protected $guarded = ['id'];





    

     public function user(){
    	return $this->belongsTo(User::class,'issued_to');
    }

     public function getStats($provider_id=null,$status=false){
     	if($status==False){
     		 $number=$this->where(['provider_id'=>$provider_id])->count();

     	}else{
        $number=$this->where(['provider_id'=>$provider_id,'status'=>$status])->count();
     	}

     	return $number;

     }
     public function items()
     {
        return $this->hasMany(InvoiceItem::class,'invoice_id');
     }


     public function space(){
    	return $this->belongsTo(Space::class);
    }

    public function provider()
    {
        return $this->belongsTo(Agent::class,'provider_id');
    }

   

    
}
