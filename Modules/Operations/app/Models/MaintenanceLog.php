<?php

namespace Modules\Operations\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Operations\Database\Factories\MaintenanceLog\MaintenanceLogFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class MaintenanceLog extends Model 
{
    /** @use HasFactory<MaintenanceLogFactory> */
    use HasFactory, HasUuids;

    
    

    
    

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'reported_by', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Modules\Hotel\Models\Room::class, 'room_id', 'id');
    }
}
