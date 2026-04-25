<?php

namespace Modules\Hotel\DTOs\BookingRoom;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Rule;

class BookingRoomData extends Data
{
    public function __construct(
        #[Rule(['exists:bookings,id'])]
        public readonly string $booking_id,
        #[Rule(['exists:rooms,id'])]
        public readonly string $room_id,
        #[Rule(['exists:room_types,id'])]
        public readonly string $room_type_id,
        #[Rule(['numeric'])]
        public readonly float $price_per_night,
        #[Rule(['integer'])]
        public readonly int $nights,
        #[Rule(['numeric'])]
        public readonly float $subtotal
    ) {}
}
