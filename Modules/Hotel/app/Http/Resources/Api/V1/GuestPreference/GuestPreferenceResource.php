<?php

namespace Modules\Hotel\Http\Resources\Api\V1\GuestPreference;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GuestPreferenceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'preferred_room_type_id' => $this->preferred_room_type_id,
            'preferred_room_type' => $this->whenLoaded('preferredRoomType'),
            'preferred_floor' => $this->preferred_floor ? (int) $this->preferred_floor : null,
            'preferred_bed_type' => $this->preferred_bed_type,
            'dietary_requirements' => $this->dietary_requirements,
            'allergies' => $this->allergies,
            'special_needs' => $this->special_needs,
            'preferred_language' => $this->preferred_language,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
