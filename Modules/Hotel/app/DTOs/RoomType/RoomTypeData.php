<?php

namespace Modules\Hotel\DTOs\RoomType;

use Spatie\LaravelData\Data;

class RoomTypeData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $slug,
        public readonly float $base_price,
        public readonly int $capacity_adults,
        public readonly int $capacity_children,
        public readonly int $size_sqm,
        public readonly string $bed_type,
        public readonly string $view_type,
        public readonly ?array $images = null,
        public readonly ?array $amenities = null,
        public readonly bool $is_active = true,
        public readonly int $sort_order = 0,
    ) {}
}
