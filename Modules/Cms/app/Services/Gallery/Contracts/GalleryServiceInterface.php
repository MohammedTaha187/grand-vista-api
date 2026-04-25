<?php

namespace Modules\Cms\Services\Gallery\Contracts;

use Modules\Cms\Models\Gallery;
use Modules\Cms\DTOs\Gallery\GalleryData;
use Illuminate\Database\Eloquent\Collection;

interface GalleryServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?Gallery;

    public function create(GalleryData $data): Gallery;

    public function update(string $id, GalleryData $data): bool;

    public function delete(string $id): bool;
}
