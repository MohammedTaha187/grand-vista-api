<?php

namespace Modules\Hotel\DTOs\Amenity;

use Spatie\LaravelData\Data;

class AmenityData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        public readonly ?string $icon = null,
        public readonly ?string $description = null,
        public readonly string $category,
        public readonly bool $is_premium = false,
        public readonly bool $is_active = true,
    ) {}
}
