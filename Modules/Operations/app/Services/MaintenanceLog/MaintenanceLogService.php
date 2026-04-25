<?php

namespace Modules\Operations\Services\MaintenanceLog;

use Modules\Operations\Services\MaintenanceLog\Contracts\MaintenanceLogServiceInterface;
use Modules\Operations\Repositories\MaintenanceLog\Contracts\MaintenanceLogRepositoryInterface;
use Modules\Operations\Models\MaintenanceLog;
use Modules\Operations\DTOs\MaintenanceLog\MaintenanceLogData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class MaintenanceLogService implements MaintenanceLogServiceInterface
{
    public function __construct(
        private readonly MaintenanceLogRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(MaintenanceLog::class)
            ->allowedFilters(...[
                'status',
                'severity',
                'issue_type',
                'room_id',
                'reported_by',
                AllowedFilter::partial('description'),
            ])
            ->allowedSorts(...['status', 'severity', 'cost', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?MaintenanceLog
    {
        return $this->repo->find($id);
    }

    public function create(MaintenanceLogData $data): MaintenanceLog
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, MaintenanceLogData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
