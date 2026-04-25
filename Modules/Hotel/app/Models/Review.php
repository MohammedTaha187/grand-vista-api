<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Hotel\Database\Factories\Review\ReviewFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Review extends Model 
{
    /** @use HasFactory<ReviewFactory> */
    use HasFactory, HasUuids;

    
    

    
    

    public function booking()
    {
        return $this->belongsTo(Modules\Hotel\Models\Booking::class, 'booking_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Modules\Hotel\Models\Room::class, 'room_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
