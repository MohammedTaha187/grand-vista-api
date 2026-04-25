<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Cms\Database\Factories\Testimonial\TestimonialFactory;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class Testimonial extends Model 
{
    /** @use HasFactory<TestimonialFactory> */
    use HasFactory, HasUuids;

    public function roomType()
    {
        return $this->belongsTo(\Modules\Hotel\Models\RoomType::class, 'room_type_id', 'id');
    }

    /**
     * Get the full URL for the guest avatar.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar ? Storage::url($this->avatar) : null;
    }
}
