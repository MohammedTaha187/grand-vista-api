<?php

namespace Modules\Hotel\Http\Resources\Api\V1\RoomAvailability;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomAvailabilityCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = RoomAvailabilityResource::class;

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
