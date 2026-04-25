<?php

namespace Modules\Cms\Http\Resources\Api\V1\BlogPost;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BlogPostCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = BlogPostResource::class;

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
