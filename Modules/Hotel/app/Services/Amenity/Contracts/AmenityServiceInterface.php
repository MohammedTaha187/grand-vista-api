<?php

namespace Modules\Hotel\Services\Amenity\Contracts;

use Modules\Hotel\Models\Amenity;
use Modules\Hotel\DTOs\Amenity\AmenityData;
use Illuminate\Database\Eloquent\Collection;

interface AmenityServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?Amenity;

    public function create(AmenityData $data): Amenity;

    public function update(string $id, AmenityData $data): bool;

    public function delete(string $id): bool;
}
