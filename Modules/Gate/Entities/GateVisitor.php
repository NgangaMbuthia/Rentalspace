<?php

namespace Modules\Gate\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;

class GateVisitor extends Model
{
    protected $guarded = ['id'];


    public function vhost(){
     return $this->belongsTo(User::class,'host_id');
    }

    public function statistics($property=false,$year=false,$month=false){
    	 if($property==false  && $year==false && $month==false){
    	 	return $this::count();
    	 }

    	 if($property==false  &&  $month==false){
    	 	$id=Auth::User()->getProvider->id;
    	 	return $this->join('properties','properties.id','=','gate_visitors.property_id')->where('properties.provider_id',$id)->whereYear('gate_visitors.created_at',$year)
    	 	     ->count();
    	 }
    	 else if($month==false){

         return $this->where('property_id',$property)->whereYear('created_at',$year)
    	 	     ->count();

    	 }elseif ($property==false) {

    	 	$id=Auth::User()->getProvider->id;
    	 	return $this->join('properties','properties.id','=','gate_visitors.property_id')->where('properties.provider_id',$id)->whereYear('gate_visitors.created_at',$year)
    	 	    ->whereMonth('gate_visitors.created_at',$month)
    	 	     ->count();
    	 	 
    	 }

    	 else{
    	 	return $this->where('property_id',$property)->whereYear('created_at',$year)
    	 	       ->whereMonth('created_at',$month)->count();
    	 }


    }
}
