<?php

namespace Modules\Setting\Services\ActivityLog\Contracts;

use Modules\Setting\Models\ActivityLog;
use Modules\Setting\DTOs\ActivityLog\ActivityLogData;
use Illuminate\Database\Eloquent\Collection;

interface ActivityLogServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?ActivityLog;

    public function create(ActivityLogData $data): ActivityLog;

    public function update(string $id, ActivityLogData $data): bool;

    public function delete(string $id): bool;
}
