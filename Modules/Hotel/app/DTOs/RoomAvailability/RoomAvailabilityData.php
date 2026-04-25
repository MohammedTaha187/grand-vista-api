<?php

namespace Modules\Hotel\DTOs\RoomAvailability;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Rule;

class RoomAvailabilityData extends Data
{
    public function __construct(
        public readonly string $room_id,
        public readonly string $date,
        public readonly string $status,
        public readonly ?string $booking_id = null,
        public readonly ?float $price_for_date = null,
        public readonly ?string $notes = null,
    ) {}
}
