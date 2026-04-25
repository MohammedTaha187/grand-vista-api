<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Hotel\Database\Factories\BookingRoom\BookingRoomFactory;

#[Guarded(['id', 'created_at', 'updated_at'])]
class BookingRoom extends Model 
{
    /** @use HasFactory<BookingRoomFactory> */
    use HasFactory, HasUuids;

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
