<?php

namespace Modules\Hotel\Services\Review;

use Modules\Hotel\Services\Review\Contracts\ReviewServiceInterface;
use Modules\Hotel\Repositories\Review\Contracts\ReviewRepositoryInterface;
use Modules\Hotel\Models\Review;
use Modules\Hotel\DTOs\Review\ReviewData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ReviewService implements ReviewServiceInterface
{
    public function __construct(
        private readonly ReviewRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(Review::class)
            ->allowedFilters(...[
                'is_approved',
                'is_featured',
                'rating',
                'room_id',
                'user_id',
                AllowedFilter::partial('title'),
                AllowedFilter::partial('comment'),
            ])
            ->allowedSorts(...['rating', 'created_at', 'is_featured'])
            ->defaultSort('-created_at')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?Review
    {
        return $this->repo->find($id);
    }

    public function create(ReviewData $data): Review
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, ReviewData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
