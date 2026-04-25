<?php

namespace Modules\Hotel\Services\RoomType\Contracts;

use Modules\Hotel\Models\RoomType;
use Modules\Hotel\DTOs\RoomType\RoomTypeData;
use Illuminate\Database\Eloquent\Collection;

interface RoomTypeServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?RoomType;

    public function create(RoomTypeData $data): RoomType;

    public function update(string $id, RoomTypeData $data): bool;

    public function delete(string $id): bool;
}
