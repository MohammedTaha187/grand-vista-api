<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Booking;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = BookingResource::class;

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
