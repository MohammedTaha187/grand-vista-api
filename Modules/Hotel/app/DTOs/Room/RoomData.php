<?php

namespace Modules\Hotel\DTOs\Room;

use Spatie\LaravelData\Data;

class RoomData extends Data
{
    public function __construct(
        public readonly string $room_type_id,
        public readonly string $room_number,
        public readonly ?int $floor = null,
        public readonly string $status = 'available',
        public readonly ?float $price_override = null,
        public readonly ?string $notes = null,
        public readonly ?string $current_guest_id = null,
        public readonly ?string $current_booking_id = null,
    ) {}
}
