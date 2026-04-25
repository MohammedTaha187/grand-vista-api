<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Favorite;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'room_type_id' => $this->room_type_id,
            'room_type' => $this->whenLoaded('roomType'),
            'created_at' => $this->created_at,
        ];
    }
}
