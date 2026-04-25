<?php

namespace Modules\Hotel\Services\BookingRoom\Contracts;

use Modules\Hotel\Models\BookingRoom;
use Modules\Hotel\DTOs\BookingRoom\BookingRoomData;
use Illuminate\Database\Eloquent\Collection;

interface BookingRoomServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?BookingRoom;

    public function create(BookingRoomData $data): BookingRoom;

    public function update(string $id, BookingRoomData $data): bool;

    public function delete(string $id): bool;
}
