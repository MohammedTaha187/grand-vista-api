<?php

namespace Modules\Hotel\Services\Room\Contracts;

use Modules\Hotel\Models\Room;
use Modules\Hotel\DTOs\Room\RoomData;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoomServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?Room;

    public function create(RoomData $data): Room;

    public function update(string $id, RoomData $data): bool;

    public function delete(string $id): bool;
}
