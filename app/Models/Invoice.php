<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const STATUS_PROCESSED = 'processed';
    const STATUS_GENERATED = 'invoice_generated';
    const STATUS_COMPLETE = 'complete';

    public function items()
    {
        return $this->hasMany(InvoiceProduct::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
