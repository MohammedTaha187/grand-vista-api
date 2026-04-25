<?php

namespace Modules\Operations\Services\HousekeepingTask\Contracts;

use Modules\Operations\Models\HousekeepingTask;
use Modules\Operations\DTOs\HousekeepingTask\HousekeepingTaskData;
use Illuminate\Pagination\LengthAwarePaginator;

interface HousekeepingTaskServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?HousekeepingTask;

    public function create(HousekeepingTaskData $data): HousekeepingTask;

    public function update(string $id, HousekeepingTaskData $data): bool;

    public function delete(string $id): bool;
}
