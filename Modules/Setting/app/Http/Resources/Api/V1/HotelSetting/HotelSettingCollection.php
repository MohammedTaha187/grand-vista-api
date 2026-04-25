<?php

namespace Modules\Setting\Http\Resources\Api\V1\HotelSetting;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HotelSettingCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = HotelSettingResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(\Illuminate\Http\Request $request): array
    {
        return parent::toArray($request);
    }
}
