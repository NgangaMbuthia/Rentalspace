<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [];

    public function invoice()
    {
    	return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
