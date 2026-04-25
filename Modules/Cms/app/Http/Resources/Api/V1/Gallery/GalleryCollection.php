<?php

namespace Modules\Cms\Http\Resources\Api\V1\Gallery;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GalleryCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = GalleryResource::class;

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
