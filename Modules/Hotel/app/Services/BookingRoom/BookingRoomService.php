<?php

namespace Modules\Hotel\Services\BookingRoom;

use Modules\Hotel\Services\BookingRoom\Contracts\BookingRoomServiceInterface;
use Modules\Hotel\Repositories\BookingRoom\Contracts\BookingRoomRepositoryInterface;
use Modules\Hotel\Models\BookingRoom;
use Modules\Hotel\DTOs\BookingRoom\BookingRoomData;

use Illuminate\Database\Eloquent\Collection;

class BookingRoomService implements BookingRoomServiceInterface
{
    public function __construct(
        private readonly BookingRoomRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?BookingRoom
    {
        return $this->repo->find($id);
    }

    public function create(BookingRoomData $data): BookingRoom
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, BookingRoomData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
