<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Hotel\Database\Factories\GuestPreference\GuestPreferenceFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class GuestPreference extends Model 
{
    /** @use HasFactory<GuestPreferenceFactory> */
    use HasFactory, HasUuids;

    protected $casts = [
        'allergies' => 'array',
    ];

    
    

    
    

    public function roomType()
    {
        return $this->belongsTo(Modules\Hotel\Models\RoomType::class, 'preferred_room_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
