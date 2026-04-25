<?php

namespace Modules\Hotel\Http\Resources\Api\V1\BookingRoom;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingRoomResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking_id' => $this->booking_id,
            'room_id' => $this->room_id,
            'room' => $this->whenLoaded('room'),
            'room_type_id' => $this->room_type_id,
            'room_type' => $this->whenLoaded('roomType'),
            'price_per_night' => (float) $this->price_per_night,
            'nights' => (int) $this->nights,
            'subtotal' => (float) $this->subtotal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
