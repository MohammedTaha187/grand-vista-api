<?php

namespace Modules\Setting\DTOs\HotelSetting;

use Spatie\LaravelData\Data;

class HotelSettingData extends Data
{
    public function __construct(
        public readonly string $key,
        public readonly ?string $value = null,
        public readonly string $type = 'string',
        public readonly string $group = 'general',
        public readonly bool $is_public = false,
    ) {}
}
