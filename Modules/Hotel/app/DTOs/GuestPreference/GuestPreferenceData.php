<?php

namespace Modules\Hotel\DTOs\GuestPreference;

use Spatie\LaravelData\Data;

class GuestPreferenceData extends Data
{
    public function __construct(
        public readonly string $user_id,
        public readonly ?string $preferred_room_type_id = null,
        public readonly ?int $preferred_floor = null,
        public readonly ?string $preferred_bed_type = null,
        public readonly ?string $dietary_requirements = null,
        public readonly ?array $allergies = null,
        public readonly ?string $special_needs = null,
        public readonly string $preferred_language = 'en',
    ) {}
}
