<?php

namespace Modules\Hotel\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class RoomType extends Model 
{
    /** @use HasFactory<RoomTypeFactory> */
    use HasFactory, HasUuids;

    protected $casts = [
        'gallery' => 'array',
        'meta_keywords' => 'array',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class, 'room_type_id');
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class, 'room_type_amenity', 'room_type_id', 'amenity_id')
            ->withTimestamps();
    }

    /**
     * Get full URLs for gallery images.
     */
    public function getGalleryUrlsAttribute(): array
    {
        if (!$this->gallery) return [];
        return array_map(fn($path) => Storage::url($path), $this->gallery);
    }

    /**
     * Get the full URL for the featured image.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? Storage::url($this->featured_image) : null;
    }

    public function getSeoMetadataAttribute(): array
    {
        return [
            'title' => $this->meta_title ?? $this->name,
            'description' => $this->meta_description ?? substr(strip_tags($this->description), 0, 160),
            'keywords' => $this->meta_keywords,
        ];
    }

    // Existing relations...
    public function testimonials()
    {
        return $this->hasMany(\Modules\Cms\Models\Testimonial::class, 'room_type_id', 'id');
    }
}
