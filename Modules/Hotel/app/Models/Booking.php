<?php

namespace Modules\Hotel\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Hotel\Database\Factories\Booking\BookingFactory;

#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Booking extends Model 
{
    /** @use HasFactory<BookingFactory> */
    use HasFactory, SoftDeletes, HasUuids;

    /**
     * Get the guest (user) that made the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the rooms associated with the booking.
     */
    public function bookingRooms(): HasMany
    {
        return $this->hasMany(BookingRoom::class, 'booking_id');
    }

    /**
     * Get the additional services associated with the booking.
     */
    public function bookingAddons(): HasMany
    {
        return $this->hasMany(BookingAddon::class, 'booking_id');
    }

    /**
     * Get the room availability records associated with the booking.
     */
    public function roomAvailabilities(): HasMany
    {
        return $this->hasMany(RoomAvailability::class, 'booking_id');
    }

    /**
     * Get the user who checked in the guest.
     */
    public function checkedInBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    /**
     * Get the user who checked out the guest.
     */
    public function checkedOutBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_out_by');
    }

    public function invoices()
    {
        return $this->hasMany(Modules\Hotel\Models\Invoice::class, 'booking_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Modules\Hotel\Models\Payment::class, 'booking_id', 'id');
    }

    public function activityLogs()
    {
        return $this->hasMany(Modules\Setting\Models\ActivityLog::class, 'booking_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Modules\Hotel\Models\Review::class, 'booking_id', 'id');
    }
}
