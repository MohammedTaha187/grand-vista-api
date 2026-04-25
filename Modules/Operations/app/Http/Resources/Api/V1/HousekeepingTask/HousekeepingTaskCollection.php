<?php

namespace Modules\Operations\Http\Resources\Api\V1\HousekeepingTask;

use Illuminate\Http\Resources\Json\ResourceCollection;

class HousekeepingTaskCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = HousekeepingTaskResource::class;

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
