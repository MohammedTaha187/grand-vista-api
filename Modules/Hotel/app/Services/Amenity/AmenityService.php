<?php

namespace Modules\Hotel\Services\Amenity;

use Modules\Hotel\Services\Amenity\Contracts\AmenityServiceInterface;
use Modules\Hotel\Repositories\Amenity\Contracts\AmenityRepositoryInterface;
use Modules\Hotel\Models\Amenity;
use Modules\Hotel\DTOs\Amenity\AmenityData;

use Illuminate\Database\Eloquent\Collection;

class AmenityService implements AmenityServiceInterface
{
    public function __construct(
        private readonly AmenityRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?Amenity
    {
        return $this->repo->find($id);
    }

    public function create(AmenityData $data): Amenity
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, AmenityData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
