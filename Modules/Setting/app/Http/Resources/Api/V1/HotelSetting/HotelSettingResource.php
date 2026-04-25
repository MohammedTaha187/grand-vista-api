<?php

namespace Modules\Setting\Http\Resources\Api\V1\HotelSetting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelSettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value,
            'type' => $this->type,
            'group' => $this->group,
            'is_public' => (bool) $this->is_public,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
