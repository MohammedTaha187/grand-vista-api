<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'),
            'booking_id' => $this->booking_id,
            'room_id' => $this->room_id,
            'room' => $this->whenLoaded('room'),
            'rating' => (int) $this->rating,
            'cleanliness_rating' => $this->cleanliness_rating ? (int) $this->cleanliness_rating : null,
            'service_rating' => $this->service_rating ? (int) $this->service_rating : null,
            'comfort_rating' => $this->comfort_rating ? (int) $this->comfort_rating : null,
            'location_rating' => $this->location_rating ? (int) $this->location_rating : null,
            'value_rating' => $this->value_rating ? (int) $this->value_rating : null,
            'title' => $this->title,
            'comment' => $this->comment,
            'is_approved' => (bool) $this->is_approved,
            'is_featured' => (bool) $this->is_featured,
            'admin_response' => $this->admin_response,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
