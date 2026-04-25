<?php

namespace Modules\Cms\Services\Offer\Contracts;

use Modules\Cms\Models\Offer;
use Modules\Cms\DTOs\Offer\OfferData;
use Illuminate\Pagination\LengthAwarePaginator;

interface OfferServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?Offer;

    public function create(OfferData $data): Offer;

    public function update(string $id, OfferData $data): bool;

    public function delete(string $id): bool;
}
