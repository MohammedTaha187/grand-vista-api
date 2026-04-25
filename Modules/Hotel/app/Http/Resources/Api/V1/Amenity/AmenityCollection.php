<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Amenity;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AmenityCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = AmenityResource::class;

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
