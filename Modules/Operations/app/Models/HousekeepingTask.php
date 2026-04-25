<?php

namespace Modules\Operations\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Operations\Database\Factories\HousekeepingTask\HousekeepingTaskFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class HousekeepingTask extends Model 
{
    /** @use HasFactory<HousekeepingTaskFactory> */
    use HasFactory, HasUuids;

    
    

    
    

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_to', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Modules\Hotel\Models\Room::class, 'room_id', 'id');
    }
}
