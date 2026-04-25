<?php

namespace Modules\Hotel\DTOs\Review;

use Spatie\LaravelData\Data;

class ReviewData extends Data
{
    public function __construct(
        public readonly string $user_id,
        public readonly string $booking_id,
        public readonly string $room_id,
        public readonly int $rating,
        public readonly ?int $cleanliness_rating = null,
        public readonly ?int $service_rating = null,
        public readonly ?int $comfort_rating = null,
        public readonly ?int $location_rating = null,
        public readonly ?int $value_rating = null,
        public readonly ?string $title = null,
        public readonly string $comment,
        public readonly bool $is_approved = false,
        public readonly bool $is_featured = false,
        public readonly ?string $admin_response = null,
    ) {}
}
