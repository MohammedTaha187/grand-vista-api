<?php

namespace Modules\Cms\DTOs\Offer;

use Spatie\LaravelData\Data;

class OfferData extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $slug,
        public readonly string $description,
        public readonly ?string $terms_conditions = null,
        public readonly string $discount_type,
        public readonly float $discount_value,
        public readonly ?int $min_nights = null,
        public readonly ?int $max_nights = null,
        public readonly string $valid_from,
        public readonly string $valid_until,
        public readonly ?array $applicable_room_types = null,
        public readonly bool $is_active = true,
        public readonly ?string $image = null,
    ) {}
}
