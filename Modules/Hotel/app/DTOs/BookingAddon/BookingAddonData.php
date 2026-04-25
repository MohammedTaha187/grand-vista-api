<?php

namespace Modules\Hotel\DTOs\BookingAddon;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Rule;

class BookingAddonData extends Data
{
    public function __construct(
        #[Rule(['exists:bookings,id'])]
        public readonly string $booking_id,
        #[Rule([''])]
        public readonly string $addon_type,
        #[Rule(['string', 'max:255'])]
        public readonly string $addon_name,
        #[Rule(['integer'])]
        public readonly int $quantity,
        #[Rule(['numeric'])]
        public readonly float $unit_price,
        #[Rule(['numeric'])]
        public readonly float $total_price
    ) {}
}
