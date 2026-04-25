<?php

namespace Modules\Hotel\Services\GuestPreference;

use Modules\Hotel\Services\GuestPreference\Contracts\GuestPreferenceServiceInterface;
use Modules\Hotel\Repositories\GuestPreference\Contracts\GuestPreferenceRepositoryInterface;
use Modules\Hotel\Models\GuestPreference;
use Modules\Hotel\DTOs\GuestPreference\GuestPreferenceData;

use Illuminate\Database\Eloquent\Collection;

class GuestPreferenceService implements GuestPreferenceServiceInterface
{
    public function __construct(
        private readonly GuestPreferenceRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?GuestPreference
    {
        return $this->repo->find($id);
    }

    public function create(GuestPreferenceData $data): GuestPreference
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, GuestPreferenceData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
