<?php

namespace Modules\Hotel\Http\Resources\Api\V1\BookingRoom;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingRoomCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = BookingRoomResource::class;

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
