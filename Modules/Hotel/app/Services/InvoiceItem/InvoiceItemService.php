<?php

namespace Modules\Hotel\Services\InvoiceItem;

use Modules\Hotel\Services\InvoiceItem\Contracts\InvoiceItemServiceInterface;
use Modules\Hotel\Repositories\InvoiceItem\Contracts\InvoiceItemRepositoryInterface;
use Modules\Hotel\Models\InvoiceItem;
use Modules\Hotel\DTOs\InvoiceItem\InvoiceItemData;

use Illuminate\Database\Eloquent\Collection;

class InvoiceItemService implements InvoiceItemServiceInterface
{
    public function __construct(
        private readonly InvoiceItemRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?InvoiceItem
    {
        return $this->repo->find($id);
    }

    public function create(InvoiceItemData $data): InvoiceItem
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, InvoiceItemData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
