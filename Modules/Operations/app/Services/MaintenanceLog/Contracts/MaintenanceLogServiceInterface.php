<?php

namespace Modules\Operations\Services\MaintenanceLog\Contracts;

use Modules\Operations\Models\MaintenanceLog;
use Modules\Operations\DTOs\MaintenanceLog\MaintenanceLogData;
use Illuminate\Pagination\LengthAwarePaginator;

interface MaintenanceLogServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?MaintenanceLog;

    public function create(MaintenanceLogData $data): MaintenanceLog;

    public function update(string $id, MaintenanceLogData $data): bool;

    public function delete(string $id): bool;
}
