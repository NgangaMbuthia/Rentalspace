<?php

namespace Modules\Tenants\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Backend\Entities\Invoice;
use App\User;
class SubmittedPayment extends Model
{
    protected $fillable = [];

    public function invoice()
    {
    	return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public function user()
    {
    	return $this->belongsTo(User::class,'user_id');
    }
}
