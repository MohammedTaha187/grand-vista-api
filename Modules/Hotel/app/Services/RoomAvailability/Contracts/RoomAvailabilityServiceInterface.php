<?php

namespace Modules\Hotel\Services\RoomAvailability\Contracts;

use Modules\Hotel\Models\RoomAvailability;
use Modules\Hotel\DTOs\RoomAvailability\RoomAvailabilityData;
use Illuminate\Database\Eloquent\Collection;

interface RoomAvailabilityServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?RoomAvailability;

    public function create(RoomAvailabilityData $data): RoomAvailability;

    public function update(string $id, RoomAvailabilityData $data): bool;

    public function delete(string $id): bool;
}
