<?php

namespace Modules\Hotel\Http\Resources\Api\V1\BookingAddon;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingAddonCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = BookingAddonResource::class;

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
