<?php

namespace Modules\Hotel\Http\Resources\Api\V1\RoomType;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Hotel\Http\Resources\Api\V1\Amenity\AmenityResource;

class RoomTypeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'pricing' => [
                'base_price' => (float) $this->base_price,
                'currency' => 'USD',
            ],
            'capacity' => [
                'adults' => (int) $this->capacity_adults,
                'children' => (int) $this->capacity_children,
            ],
            'specifications' => [
                'size_sqm' => (int) $this->size_sqm,
                'bed_type' => $this->bed_type,
                'view_type' => $this->view_type,
            ],
            'media' => [
                'featured_image' => $this->featured_image_url,
                'gallery' => $this->gallery_urls,
            ],
            'amenities' => AmenityResource::collection($this->whenLoaded('amenities')),
            'seo' => $this->seo_metadata,
            'status' => [
                'is_active' => (bool) $this->is_active,
                'rooms_count' => $this->whenCounted('rooms'),
            ],
            'timestamps' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
