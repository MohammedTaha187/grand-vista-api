<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Amenity;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AmenityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => $this->category,
            'media' => [
                'icon' => $this->icon_url,
            ],
            'status' => [
                'is_premium' => (bool) $this->is_premium,
                'is_active' => (bool) $this->is_active,
            ],
            'timestamps' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
