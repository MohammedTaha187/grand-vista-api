<?php

namespace Modules\Hotel\Services\RoomAvailability;

use Modules\Hotel\Services\RoomAvailability\Contracts\RoomAvailabilityServiceInterface;
use Modules\Hotel\Repositories\RoomAvailability\Contracts\RoomAvailabilityRepositoryInterface;
use Modules\Hotel\Models\RoomAvailability;
use Modules\Hotel\DTOs\RoomAvailability\RoomAvailabilityData;

use Illuminate\Database\Eloquent\Collection;

class RoomAvailabilityService implements RoomAvailabilityServiceInterface
{
    public function __construct(
        private readonly RoomAvailabilityRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?RoomAvailability
    {
        return $this->repo->find($id);
    }

    public function create(RoomAvailabilityData $data): RoomAvailability
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, RoomAvailabilityData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
