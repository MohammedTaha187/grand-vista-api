<?php

namespace Modules\Cms\Http\Resources\Api\V1\Testimonial;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TestimonialCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = TestimonialResource::class;

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
