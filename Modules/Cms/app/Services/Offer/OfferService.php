<?php

namespace Modules\Cms\Services\Offer;

use Modules\Cms\Services\Offer\Contracts\OfferServiceInterface;
use Modules\Cms\Repositories\Offer\Contracts\OfferRepositoryInterface;
use Modules\Cms\Models\Offer;
use Modules\Cms\DTOs\Offer\OfferData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class OfferService implements OfferServiceInterface
{
    public function __construct(
        private readonly OfferRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(Offer::class)
            ->allowedFilters(...[
                'discount_type',
                'is_active',
                AllowedFilter::partial('title'),
                AllowedFilter::callback('valid_at', function ($query, $value) {
                    $query->where('valid_from', '<=', $value)
                        ->where('valid_until', '>=', $value);
                }),
                AllowedFilter::callback('min_discount', function ($query, $value) {
                    $query->where('discount_value', '>=', $value);
                }),
            ])
            ->allowedSorts(...['title', 'discount_value', 'valid_from', 'valid_until', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?Offer
    {
        return $this->repo->find($id);
    }

    public function create(OfferData $data): Offer
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, OfferData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
