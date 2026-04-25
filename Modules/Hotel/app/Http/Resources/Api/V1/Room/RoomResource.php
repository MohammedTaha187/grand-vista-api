<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Room;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_type_id' => $this->room_type_id,
            'room_type' => $this->whenLoaded('roomType'),
            'current_guest_id' => $this->current_guest_id,
            'current_guest' => $this->whenLoaded('currentGuest'),
            'current_booking_id' => $this->current_booking_id,
            'room_number' => $this->room_number,
            'floor' => (int) $this->floor,
            'status' => $this->status,
            'price_override' => $this->price_override ? (float) $this->price_override : null,
            'notes' => $this->notes,
            'last_cleaned_at' => $this->last_cleaned_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
