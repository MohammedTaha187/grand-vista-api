<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Hotel\Database\Factories\Favorite\FavoriteFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Favorite extends Model 
{
    /** @use HasFactory<FavoriteFactory> */
    use HasFactory, HasUuids;

    
    

    
    

    public function roomType()
    {
        return $this->belongsTo(Modules\Hotel\Models\RoomType::class, 'room_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
}
