<?php

namespace Modules\Operations\Services\HousekeepingTask;

use Modules\Operations\Services\HousekeepingTask\Contracts\HousekeepingTaskServiceInterface;
use Modules\Operations\Repositories\HousekeepingTask\Contracts\HousekeepingTaskRepositoryInterface;
use Modules\Operations\Models\HousekeepingTask;
use Modules\Operations\DTOs\HousekeepingTask\HousekeepingTaskData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class HousekeepingTaskService implements HousekeepingTaskServiceInterface
{
    public function __construct(
        private readonly HousekeepingTaskRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(HousekeepingTask::class)
            ->allowedFilters(...[
                'status',
                'priority',
                'task_type',
                'room_id',
                'assigned_to',
                AllowedFilter::callback('scheduled_at', function ($query, $value) {
                    $query->whereDate('scheduled_at', $value);
                }),
            ])
            ->allowedSorts(...['scheduled_at', 'priority', 'status', 'created_at'])
            ->defaultSort('scheduled_at')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?HousekeepingTask
    {
        return $this->repo->find($id);
    }

    public function create(HousekeepingTaskData $data): HousekeepingTask
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, HousekeepingTaskData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
