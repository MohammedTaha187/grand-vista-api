<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Hotel\Models\Booking;
use Modules\Setting\Database\Factories\ActivityLog\ActivityLogFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class ActivityLog extends Model 
{
    /** @use HasFactory<ActivityLogFactory> */
    use HasFactory, HasUuids;
    
    const UPDATED_AT = null;

    
    

    
    

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
