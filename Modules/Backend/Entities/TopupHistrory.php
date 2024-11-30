<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Agent;

class TopupHistrory extends Model
{
	protected $table="topup_histories";
    protected $guarded = ['id'];

        public function statisticsCount($property=false,$year=false,$month=false){
    	$id=\Auth::User()->getProvider->id;
         if($property==false  && $year==false && $month==false){
            return $this::count();
         }

         if($property==false  &&  $month==false){
            $id=Auth::User()->getProvider->id;
            return $this->where('owner_id',$id)->whereYear('created_at',$year)
               ->where(['status'=>'Accepted'])
                ->count();
         }

           if($year==false  &&  $month==false){
             return $this->where('owner_id',$id)
                ->where(['status'=>'Accepted'])
                ->count();
         }
         else if($month==false){

         return $this->where('owner_id',$id)->whereYear('created_at',$year)
              ->where(['status'=>'Accepted'])
               
               ->count();

         }
         else if($year==false){

         return $this->where('owner_id',$id)->whereMonth('created_at',$month)
             ->where(['status'=>'Accepted'])
               ->count();

         }


         elseif ($property==false) {

            $id=Auth::User()->getProvider->id;
            return $this->where('owner_id',$id)->whereYear('created_at',$year)
                ->whereMonth('created_at',$month)
                ->where(['status'=>'Accepted'])
               ->count();
             
         }

         else{
               $id=\Auth::User()->getProvider->id;
          //return $property->id;

            return $this->where('owner_id',$id)->whereYear('created_at',$year)
                ->where(['status'=>'Accepted'])
                ->whereMonth('created_at',$month)
                ->count();
         }
    }

    public function statistics($property=false,$year=false,$month=false){
    	$id=\Auth::User()->getProvider->id;
         if($property==false  && $year==false && $month==false){
            return $this::count();
         }

         if($property==false  &&  $month==false){
            $id=Auth::User()->getProvider->id;
            return $this->where('owner_id',$id)->whereYear('created_at',$year)
                ->sum('amount');
         }

           if($year==false  &&  $month==false){
             return $this->where('owner_id',$id)
                 ->where(['status'=>'Accepted'])
               ->sum('amount');
         }
         else if($month==false){

         return $this->where('owner_id',$id)->whereYear('created_at',$year)
               ->where(['status'=>'Accepted'])
               
               ->sum('amount');

         }
         else if($year==false){

         return $this->where('owner_id',$id)->whereMonth('created_at',$month)
                ->where(['status'=>'Accepted'])
              ->sum('amount');

         }


         elseif ($property==false) {

            $id=Auth::User()->getProvider->id;
            return $this->where('owner_id',$id)->whereYear('created_at',$year)
                ->whereMonth('created_at',$month)
                ->where(['status'=>'Accepted'])
               ->sum('amount');
             
         }

         else{
               $id=\Auth::User()->getProvider->id;
          //return $property->id;

            return $this->where('owner_id',$id)->whereYear('created_at',$year)
                ->whereMonth('created_at',$month)
                ->where(['status'=>'Accepted'])
                ->sum('amount');
         }
    }


    public function agent(){
        return $this->belongsTo(Agent::class,'owner_id');
    }
}
