<?php

namespace Modules\Hotel\Services\BookingAddon\Contracts;

use Modules\Hotel\Models\BookingAddon;
use Modules\Hotel\DTOs\BookingAddon\BookingAddonData;
use Illuminate\Database\Eloquent\Collection;

interface BookingAddonServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?BookingAddon;

    public function create(BookingAddonData $data): BookingAddon;

    public function update(string $id, BookingAddonData $data): bool;

    public function delete(string $id): bool;
}
