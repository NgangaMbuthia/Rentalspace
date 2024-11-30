<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Amentity;
use Modules\Backend\Entities\Agent;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\SubCategory;
use Modules\Backend\Entities\Space;
use Modules\Backend\Entities\Tenant;
use Modules\Backend\Entities\PropertyImage;

class Property extends Model
{
    protected $guarded = ['id'];


    public function amentities(){
    	return $this->hasMany(Amentity::class,'property_id');
    }

    public function tenants()
    {
        return $this->hasManyThrough('Modules\Backend\Entities\Tenant', 'Modules\Backend\Entities\Space');
    }


     public function setNoOfBedroomsAttribute($value)
    {
          if(empty($value)){
            $value=0;
          }
           
        $this->attributes['no_of_bedrooms'] = $value;
    }
    public function setNoOfBathroomAttribute($value)
    {
          if(empty($value)){
            $value=0;
          }
        $this->attributes['no_of_bathroom'] = $value;
    }


     
    

    

    public function getProvider(){
  return $this->belongsTo(Agent::class,'provider_id');
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

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function spaces(){
        return $this->hasMany(Space::class,'property_id');
    }

     public function repairs()
    {
        return $this->hasManyThrough('Modules\Backend\Entities\Repair',Space::class);
    }

    public function images(){
      return $this->hasMany(PropertyImage::class,'property_id');
    }

    public function from_price($id){
        $price=Space::where('property_id',$id)->min('unit_price');
        return $price;      
    }
}
