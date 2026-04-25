<?php

namespace Modules\Hotel\Http\Resources\Api\V1\RoomAvailability;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomAvailabilityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'room' => $this->whenLoaded('room'),
            'date' => $this->date,
            'status' => $this->status,
            'booking_id' => $this->booking_id,
            'price_for_date' => $this->price_for_date ? (float) $this->price_for_date : null,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
