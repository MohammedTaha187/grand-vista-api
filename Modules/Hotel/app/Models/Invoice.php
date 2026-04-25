<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Hotel\Database\Factories\Invoice\InvoiceFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Invoice extends Model 
{
    /** @use HasFactory<InvoiceFactory> */
    use HasFactory, HasUuids;

    
    

    
    

    public function booking()
    {
        return $this->belongsTo(Modules\Hotel\Models\Booking::class, 'booking_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function invoiceItems()
    {
        return $this->hasMany(Modules\Hotel\Models\InvoiceItem::class, 'invoice_id', 'id');
    }
}
