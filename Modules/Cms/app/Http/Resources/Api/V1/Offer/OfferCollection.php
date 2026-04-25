<?php

namespace Modules\Cms\Http\Resources\Api\V1\Offer;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OfferCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = OfferResource::class;

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
