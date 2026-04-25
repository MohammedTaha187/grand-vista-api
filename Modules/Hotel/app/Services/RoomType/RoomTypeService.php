<?php

namespace Modules\Hotel\Services\RoomType;

use Modules\Hotel\Services\RoomType\Contracts\RoomTypeServiceInterface;
use Modules\Hotel\Repositories\RoomType\Contracts\RoomTypeRepositoryInterface;
use Modules\Hotel\Models\RoomType;
use Modules\Hotel\DTOs\RoomType\RoomTypeData;

use Illuminate\Database\Eloquent\Collection;

class RoomTypeService implements RoomTypeServiceInterface
{
    public function __construct(
        private readonly RoomTypeRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?RoomType
    {
        return $this->repo->find($id);
    }

    public function create(RoomTypeData $data): RoomType
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, RoomTypeData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
