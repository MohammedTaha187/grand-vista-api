<?php

namespace Modules\Hotel\Services\GuestPreference\Contracts;

use Modules\Hotel\Models\GuestPreference;
use Modules\Hotel\DTOs\GuestPreference\GuestPreferenceData;
use Illuminate\Database\Eloquent\Collection;

interface GuestPreferenceServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?GuestPreference;

    public function create(GuestPreferenceData $data): GuestPreference;

    public function update(string $id, GuestPreferenceData $data): bool;

    public function delete(string $id): bool;
}
