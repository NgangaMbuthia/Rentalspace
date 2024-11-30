<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class TemplateImage extends Model
{
	protected $table="templates_images";
    protected $guarded = ['id'];
}
