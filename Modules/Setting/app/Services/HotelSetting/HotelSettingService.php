<?php

namespace Modules\Setting\Services\HotelSetting;

use Modules\Setting\Services\HotelSetting\Contracts\HotelSettingServiceInterface;
use Modules\Setting\Repositories\HotelSetting\Contracts\HotelSettingRepositoryInterface;
use Modules\Setting\Models\HotelSetting;
use Modules\Setting\DTOs\HotelSetting\HotelSettingData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class HotelSettingService implements HotelSettingServiceInterface
{
    public function __construct(
        private readonly HotelSettingRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(HotelSetting::class)
            ->allowedFilters(...[
                'group',
                'type',
                'is_public',
                AllowedFilter::partial('key'),
                AllowedFilter::partial('value'),
            ])
            ->allowedSorts(...['key', 'group', 'created_at'])
            ->defaultSort('group', 'key')
            ->paginate(request()->query('per_page', 50))
            ->withQueryString();
    }

    public function getById(string $id): ?HotelSetting
    {
        return $this->repo->find($id);
    }

    public function create(HotelSettingData $data): HotelSetting
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, HotelSettingData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
