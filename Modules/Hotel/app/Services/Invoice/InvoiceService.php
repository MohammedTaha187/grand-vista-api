<?php

namespace Modules\Hotel\Services\Invoice;

use Modules\Hotel\Services\Invoice\Contracts\InvoiceServiceInterface;
use Modules\Hotel\Repositories\Invoice\Contracts\InvoiceRepositoryInterface;
use Modules\Hotel\Models\Invoice;
use Modules\Hotel\DTOs\Invoice\InvoiceData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class InvoiceService implements InvoiceServiceInterface
{
    public function __construct(
        private readonly InvoiceRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(Invoice::class)
            ->allowedFilters(...[
                'status',
                'user_id',
                'booking_id',
                AllowedFilter::partial('invoice_number'),
                AllowedFilter::callback('min_amount', function ($query, $value) {
                    $query->where('total_amount', '>=', $value);
                }),
                AllowedFilter::callback('max_amount', function ($query, $value) {
                    $query->where('total_amount', '<=', $value);
                }),
                AllowedFilter::callback('date_from', function ($query, $value) {
                    $query->where('issue_date', '>=', $value);
                }),
                AllowedFilter::callback('date_to', function ($query, $value) {
                    $query->where('issue_date', '<=', $value);
                }),
            ])
            ->allowedSorts(...['invoice_number', 'issue_date', 'total_amount', 'status', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?Invoice
    {
        return $this->repo->find($id);
    }

    public function create(InvoiceData $data): Invoice
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, InvoiceData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
