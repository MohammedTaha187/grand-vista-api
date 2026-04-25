<?php

namespace Modules\Setting\DTOs\ActivityLog;

use Spatie\LaravelData\Data;

class ActivityLogData extends Data
{
    public function __construct(
        public readonly ?string $user_id = null,
        public readonly ?string $booking_id = null,
        public readonly string $action,
        public readonly string $entity_type,
        public readonly string $entity_id,
        public readonly string $description,
        public readonly ?string $ip_address = null,
        public readonly ?string $user_agent = null,
    ) {}
}
