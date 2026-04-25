<?php

namespace Modules\Hotel\Services\Invoice\Contracts;

use Modules\Hotel\Models\Invoice;
use Modules\Hotel\DTOs\Invoice\InvoiceData;
use Illuminate\Pagination\LengthAwarePaginator;

interface InvoiceServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?Invoice;

    public function create(InvoiceData $data): Invoice;

    public function update(string $id, InvoiceData $data): bool;

    public function delete(string $id): bool;
}
