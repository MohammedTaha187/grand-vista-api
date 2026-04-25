<?php

namespace Modules\Cms\DTOs\BlogPost;

use Spatie\LaravelData\Data;

class BlogPostData extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $excerpt,
        public readonly string $content,
        public readonly ?string $featured_image = null,
        public readonly string $author_id,
        public readonly string $category,
        public readonly ?array $tags = null,
        public readonly bool $is_published = false,
        public readonly ?string $published_at = null,
        public readonly ?string $meta_title = null,
        public readonly ?string $meta_description = null,
    ) {}
}
