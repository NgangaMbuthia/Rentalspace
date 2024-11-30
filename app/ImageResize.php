<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Upload;

class ImageResize extends Model
{
    //

   protected $table="image_resizes";
   protected $guarded=['id'];

   public function image(){
        return $this->belongsTo(Upload::class,'image_id');
      }

}
