<?php

namespace Modules\Cms\Http\Resources\Api\V1\Testimonial;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'guest' => [
                'name' => $this->guest_name,
                'country' => $this->guest_country,
                'avatar' => $this->avatar_url,
            ],
            'feedback' => [
                'rating' => (int) $this->rating,
                'comment' => $this->comment,
            ],
            'context' => [
                'room_type' => $this->whenLoaded('roomType'),
                'stay_dates' => $this->stay_dates,
            ],
            'status' => [
                'is_featured' => (bool) $this->is_featured,
                'is_approved' => (bool) $this->is_approved,
            ],
            'timestamps' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
