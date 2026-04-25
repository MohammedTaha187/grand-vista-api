<?php

namespace Modules\Hotel\Services\Favorite;

use Modules\Hotel\Services\Favorite\Contracts\FavoriteServiceInterface;
use Modules\Hotel\Repositories\Favorite\Contracts\FavoriteRepositoryInterface;
use Modules\Hotel\Models\Favorite;
use Modules\Hotel\DTOs\Favorite\FavoriteData;

use Illuminate\Database\Eloquent\Collection;

class FavoriteService implements FavoriteServiceInterface
{
    public function __construct(
        private readonly FavoriteRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?Favorite
    {
        return $this->repo->find($id);
    }

    public function create(FavoriteData $data): Favorite
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, FavoriteData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
