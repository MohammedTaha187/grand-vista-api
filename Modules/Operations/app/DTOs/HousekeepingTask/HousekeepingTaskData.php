<?php

namespace Modules\Operations\DTOs\HousekeepingTask;

use Spatie\LaravelData\Data;

class HousekeepingTaskData extends Data
{
    public function __construct(
        public readonly string $room_id,
        public readonly ?string $assigned_to = null,
        public readonly string $task_type,
        public readonly string $priority = 'medium',
        public readonly string $status = 'pending',
        public readonly string $scheduled_at,
        public readonly ?string $completed_at = null,
        public readonly ?string $notes = null,
    ) {}
}
