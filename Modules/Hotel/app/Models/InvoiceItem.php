<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Hotel\Database\Factories\InvoiceItem\InvoiceItemFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class InvoiceItem extends Model 
{
    /** @use HasFactory<InvoiceItemFactory> */
    use HasFactory, HasUuids;

    
    

    
    

    public function invoice()
    {
        return $this->belongsTo(Modules\Hotel\Models\Invoice::class, 'invoice_id', 'id');
    }
}
