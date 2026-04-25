<?php

namespace Modules\Hotel\Services\Room;

use Modules\Hotel\Services\Room\Contracts\RoomServiceInterface;
use Modules\Hotel\Repositories\Room\Contracts\RoomRepositoryInterface;
use Modules\Hotel\Models\Room;
use Modules\Hotel\DTOs\Room\RoomData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class RoomService implements RoomServiceInterface
{
    public function __construct(
        private readonly RoomRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(Room::class)
            ->allowedFilters(...[
                'status',
                'room_type_id',
                'floor',
                AllowedFilter::partial('room_number'),
                AllowedFilter::callback('min_price', function ($query, $value) {
                    $query->where('price_override', '>=', $value);
                }),
                AllowedFilter::callback('max_price', function ($query, $value) {
                    $query->where('price_override', '<=', $value);
                }),
            ])
            ->allowedSorts(...['room_number', 'floor', 'status', 'price_override', 'created_at'])
            ->defaultSort('room_number')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?Room
    {
        return $this->repo->find($id);
    }

    public function create(RoomData $data): Room
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, RoomData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
