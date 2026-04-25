<?php

namespace Modules\Hotel\Services\Favorite\Contracts;

use Modules\Hotel\Models\Favorite;
use Modules\Hotel\DTOs\Favorite\FavoriteData;
use Illuminate\Database\Eloquent\Collection;

interface FavoriteServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?Favorite;

    public function create(FavoriteData $data): Favorite;

    public function update(string $id, FavoriteData $data): bool;

    public function delete(string $id): bool;
}
