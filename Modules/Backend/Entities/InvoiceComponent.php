<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class InvoiceComponent extends Model
{
	protected $table="invoice_componets";
	public $timestamps = false;
    protected $fillable = [];
}
