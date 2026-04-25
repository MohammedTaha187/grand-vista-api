<?php

namespace Modules\Cms\Services\Gallery;

use Modules\Cms\Services\Gallery\Contracts\GalleryServiceInterface;
use Modules\Cms\Repositories\Gallery\Contracts\GalleryRepositoryInterface;
use Modules\Cms\Models\Gallery;
use Modules\Cms\DTOs\Gallery\GalleryData;

use Illuminate\Database\Eloquent\Collection;

class GalleryService implements GalleryServiceInterface
{
    public function __construct(
        private readonly GalleryRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?Gallery
    {
        return $this->repo->find($id);
    }

    public function create(GalleryData $data): Gallery
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, GalleryData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
