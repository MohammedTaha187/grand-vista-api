<?php

namespace Modules\Operations\DTOs\MaintenanceLog;

use Spatie\LaravelData\Data;

class MaintenanceLogData extends Data
{
    public function __construct(
        public readonly string $room_id,
        public readonly string $reported_by,
        public readonly string $issue_type,
        public readonly string $description,
        public readonly string $severity = 'moderate',
        public readonly string $status = 'reported',
        public readonly ?string $resolved_at = null,
        public readonly ?string $resolved_by = null,
        public readonly ?float $cost = null,
    ) {}
}
