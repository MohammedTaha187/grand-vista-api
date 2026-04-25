<?php

namespace Modules\Hotel\Services\BookingAddon;

use Modules\Hotel\Services\BookingAddon\Contracts\BookingAddonServiceInterface;
use Modules\Hotel\Repositories\BookingAddon\Contracts\BookingAddonRepositoryInterface;
use Modules\Hotel\Models\BookingAddon;
use Modules\Hotel\DTOs\BookingAddon\BookingAddonData;

use Illuminate\Database\Eloquent\Collection;

class BookingAddonService implements BookingAddonServiceInterface
{
    public function __construct(
        private readonly BookingAddonRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?BookingAddon
    {
        return $this->repo->find($id);
    }

    public function create(BookingAddonData $data): BookingAddon
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, BookingAddonData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
