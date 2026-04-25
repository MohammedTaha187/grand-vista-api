<?php

namespace Modules\Hotel\Services\InvoiceItem\Contracts;

use Modules\Hotel\Models\InvoiceItem;
use Modules\Hotel\DTOs\InvoiceItem\InvoiceItemData;
use Illuminate\Database\Eloquent\Collection;

interface InvoiceItemServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?InvoiceItem;

    public function create(InvoiceItemData $data): InvoiceItem;

    public function update(string $id, InvoiceItemData $data): bool;

    public function delete(string $id): bool;
}
