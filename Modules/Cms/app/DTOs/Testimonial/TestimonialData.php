<?php

namespace Modules\Cms\DTOs\Testimonial;

use Spatie\LaravelData\Data;

class TestimonialData extends Data
{
    public function __construct(
        public readonly string $guest_name,
        public readonly string $guest_country,
        public readonly ?string $guest_avatar = null,
        public readonly int $rating,
        public readonly string $comment,
        public readonly ?string $room_type_id = null,
        public readonly ?string $stay_dates = null,
        public readonly bool $is_featured = false,
        public readonly bool $is_approved = false,
    ) {}
}
