<?php

namespace Modules\Setting\Services\ActivityLog;

use Modules\Setting\Services\ActivityLog\Contracts\ActivityLogServiceInterface;
use Modules\Setting\Repositories\ActivityLog\Contracts\ActivityLogRepositoryInterface;
use Modules\Setting\Models\ActivityLog;
use Modules\Setting\DTOs\ActivityLog\ActivityLogData;

use Illuminate\Database\Eloquent\Collection;

class ActivityLogService implements ActivityLogServiceInterface
{
    public function __construct(
        private readonly ActivityLogRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?ActivityLog
    {
        return $this->repo->find($id);
    }

    public function create(ActivityLogData $data): ActivityLog
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, ActivityLogData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
