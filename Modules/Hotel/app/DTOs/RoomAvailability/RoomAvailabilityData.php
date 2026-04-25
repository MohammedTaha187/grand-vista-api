<?php

namespace Modules\Hotel\DTOs\RoomAvailability;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Rule;

class RoomAvailabilityData extends Data
{
    public function __construct(
        public readonly string $name
    ) {}
}
