<?php

namespace Modules\Cms\DTOs\Gallery;

use Spatie\LaravelData\Data;

class GalleryData extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $category,
        public readonly string $image_url,
        public readonly ?string $thumbnail_url = null,
        public readonly ?string $caption = null,
        public readonly int $sort_order = 0,
        public readonly bool $is_featured = false,
    ) {}
}
