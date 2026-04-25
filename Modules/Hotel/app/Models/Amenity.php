<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Hotel\Database\Factories\Amenity\AmenityFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Amenity extends Model 
{
    /** @use HasFactory<AmenityFactory> */
    use HasFactory, HasUuids;

    /**
     * The room types that belong to the amenity.
     */
    public function roomTypes(): BelongsToMany
    {
        return $this->belongsToMany(RoomType::class, 'room_type_amenity', 'amenity_id', 'room_type_id')
            ->withTimestamps();
    }

    /**
     * Get the full URL for the amenity icon.
     */
    public function getIconUrlAttribute(): ?string
    {
        return $this->icon ? Storage::url($this->icon) : null;
    }
}
