<?php

namespace Modules\Cms\DTOs\Faq;

use Spatie\LaravelData\Data;

class FaqData extends Data
{
    public function __construct(
        public readonly string $question,
        public readonly string $answer,
        public readonly string $category,
        public readonly int $sort_order = 0,
        public readonly bool $is_active = true,
    ) {}
}
