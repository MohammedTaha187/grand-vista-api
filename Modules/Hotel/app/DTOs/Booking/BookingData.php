<?php

namespace Modules\Hotel\DTOs\Booking;

use Spatie\LaravelData\Data;

class BookingData extends Data
{
    public function __construct(
        public readonly string $room_id,
        public readonly string $check_in_date,
        public readonly string $check_out_date,
        public readonly string $guest_name,
        public readonly string $guest_email,
        public readonly string $guest_phone,
        public readonly int $adults,
        public readonly int $children = 0,
        public readonly ?string $special_requests = null,
        public readonly ?string $user_id = null,
        public readonly string $status = 'pending',
        public readonly string $source = 'website',
    ) {}
}
