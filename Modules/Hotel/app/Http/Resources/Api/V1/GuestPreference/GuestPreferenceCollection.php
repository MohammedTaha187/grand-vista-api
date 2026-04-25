<?php

namespace Modules\Hotel\Http\Resources\Api\V1\GuestPreference;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GuestPreferenceCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = GuestPreferenceResource::class;

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
