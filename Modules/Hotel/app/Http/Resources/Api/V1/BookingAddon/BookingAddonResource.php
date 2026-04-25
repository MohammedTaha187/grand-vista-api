<?php

namespace Modules\Hotel\Http\Resources\Api\V1\BookingAddon;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingAddonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking_id' => $this->booking_id,
            'addon_type' => $this->addon_type,
            'addon_name' => $this->addon_name,
            'quantity' => (int) $this->quantity,
            'unit_price' => (float) $this->unit_price,
            'total_price' => (float) $this->total_price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
