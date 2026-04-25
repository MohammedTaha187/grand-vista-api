<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Hotel\Database\Factories\BookingAddon\BookingAddonFactory;

#[Guarded(['id', 'created_at', 'updated_at'])]
class BookingAddon extends Model 
{
    /** @use HasFactory<BookingAddonFactory> */
    use HasFactory, HasUuids;

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
