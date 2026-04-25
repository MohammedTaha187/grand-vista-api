<?php

namespace Modules\Hotel\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Hotel\Database\Factories\Room\RoomFactory;

use Illuminate\Database\Eloquent\Concerns\HasUuids;

#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Room extends Model 
{
    /** @use HasFactory<RoomFactory> */
    use HasFactory, HasUuids;

    /**
     * Get the room type that owns the room.
     */
    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    /**
     * Get the current guest staying in the room.
     */
    public function currentGuest(): BelongsTo
    {
        return $this->belongsTo(User::class, 'current_guest_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'current_guest_id', 'id');
    }

    public function bookingRooms()
    {
        return $this->hasMany(\App\Models\BookingRoom::class, 'room_id', 'id');
    }

    public function roomAvailabilities()
    {
        return $this->hasMany(\App\Models\RoomAvailability::class, 'room_id', 'id');
    }

    public function housekeepingTasks()
    {
        return $this->hasMany(Modules\Operations\Models\HousekeepingTask::class, 'room_id', 'id');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(Modules\Operations\Models\MaintenanceLog::class, 'room_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Modules\Hotel\Models\Review::class, 'room_id', 'id');
    }
}
