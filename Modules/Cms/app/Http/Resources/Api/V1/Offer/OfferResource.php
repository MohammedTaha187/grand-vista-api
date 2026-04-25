<?php

namespace Modules\Cms\Http\Resources\Api\V1\Offer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'terms_conditions' => $this->terms_conditions,
            'discount_type' => $this->discount_type,
            'discount_value' => (float) $this->discount_value,
            'min_nights' => $this->min_nights,
            'max_nights' => $this->max_nights,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
            'applicable_room_types' => $this->applicable_room_types,
            'is_active' => (bool) $this->is_active,
            'image' => $this->image,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
