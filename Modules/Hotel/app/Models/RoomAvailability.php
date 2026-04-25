<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Hotel\Database\Factories\RoomAvailability\RoomAvailabilityFactory;

#[Guarded(['id', 'created_at', 'updated_at'])]
class RoomAvailability extends Model 
{
    /** @use HasFactory<RoomAvailabilityFactory> */
    use HasFactory, HasUuids;

    protected $casts = [
        'date' => 'date',
        'price_for_date' => 'float',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_availability';

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
