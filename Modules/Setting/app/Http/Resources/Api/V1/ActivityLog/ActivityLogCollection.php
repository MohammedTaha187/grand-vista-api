<?php

namespace Modules\Setting\Http\Resources\Api\V1\ActivityLog;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityLogCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = ActivityLogResource::class;

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
