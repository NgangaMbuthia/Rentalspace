<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\RepairItem;
use Auth;

class Repair extends Model
{
    protected $guarded= ['id'];

     public function space(){
    	return $this->belongsTo(Space::class);
    }


    public function items(){
    	return $this->hasMany(RepairItem::class,'repair_id');
    }

    public function statistics($property=false,$year=false,$month=false){
    	$id=\Auth::User()->getProvider->id;
         if($property==false  && $year==false && $month==false){
            return $this::count();
         }

         if($property==false  &&  $month==false){
            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','repairs.space_id')->where('repairs.provider_id',$id)->whereYear('repairs.created_at',$year)
                ->sum('total_cost');
         }

           if($year==false  &&  $month==false){
             return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)
                ->where('repairs.provider_id',$id)
                 ->sum('total_cost');
         }
         else if($month==false){

         return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)->whereYear('repairs.created_at',$year)
                ->where('repairs.provider_id',$id)
                ->sum('total_cost');

         }

         else if($year==false){

         return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)->whereMonth('repairs.created_at',$month)
                ->where('repairs.provider_id',$id)
                ->sum('total_cost');

         }


         elseif ($property==false) {

            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','repairs.space_id')->where('provider_id',$id)->whereYear('repairs.created_at',$year)
                ->whereMonth('repairs.created_at',$month)
                ->sum('total_cost');
             
         }

         else{
               $id=\Auth::User()->getProvider->id;
          //return $property->id;
            return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)->whereYear('repairs.created_at',$year)
                ->where('repairs.provider_id',$id)
                ->whereMonth('repairs.created_at',$month)->sum('total_cost');
         }
    }


    public function statisticsCount($property=false,$year=false,$month=false){
    	$id=\Auth::User()->getProvider->id;
         if($property==false  && $year==false && $month==false){
            return $this::count();
         }

         if($property==false  &&  $month==false){
            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','repairs.space_id')->where('repairs.provider_id',$id)->whereYear('repairs.created_at',$year)
                ->count();
         }

           if($year==false  &&  $month==false){
             return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)
                ->where('repairs.provider_id',$id)
                ->count();
         }
         else if($month==false){

         return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)->whereYear('repairs.created_at',$year)
                ->where('repairs.provider_id',$id)
               ->count();

         }
         else if($year==false){

         return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)->whereMonth('repairs.created_at',$month)
                ->where('repairs.provider_id',$id)
               ->count();

         }


         elseif ($property==false) {

            $id=Auth::User()->getProvider->id;
            return $this->join('spaces','spaces.id','=','repairs.space_id')->where('provider_id',$id)->whereYear('repairs.created_at',$year)
                ->whereMonth('repairs.created_at',$month)
               ->count();
             
         }

         else{
               $id=\Auth::User()->getProvider->id;
          //return $property->id;

            return $this->join('spaces','spaces.id','=','repairs.space_id')->where('spaces.property_id',$property->id)->whereYear('repairs.created_at',$year)
                ->where('repairs.provider_id',$id)
                ->whereMonth('repairs.created_at',$month)
                ->count();
         }
    }


     
}
