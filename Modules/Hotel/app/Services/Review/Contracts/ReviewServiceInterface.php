<?php

namespace Modules\Hotel\Services\Review\Contracts;

use Modules\Hotel\Models\Review;
use Modules\Hotel\DTOs\Review\ReviewData;
use Illuminate\Pagination\LengthAwarePaginator;

interface ReviewServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?Review;

    public function create(ReviewData $data): Review;

    public function update(string $id, ReviewData $data): bool;

    public function delete(string $id): bool;
}
