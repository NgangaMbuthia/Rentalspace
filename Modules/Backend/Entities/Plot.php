<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\PlotImage;
use App\Mymodel;

class Plot extends Mymodel
{
    protected $fillable = [];

    public function images(){
    	return $this->hasMany(PlotImage::class,'plot_id');
    }
}
