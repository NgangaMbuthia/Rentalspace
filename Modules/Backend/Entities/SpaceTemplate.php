<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Mymodel;
use Modules\Backend\Entities\TemplateAttribute;
use Modules\Backend\Entities\TemplateImage;
class SpaceTemplate extends Mymodel
{
	protected $table="spaces_templates";
    protected $guarded= ['id'];

    public function attributes()
    {
    	return $this->hasMany(TemplateAttribute::class,'template_id');
    }

    public function images()
    {
    	return $this->hasMany(TemplateImage::class,'template_id');
    }
}
