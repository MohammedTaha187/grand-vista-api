<?php

namespace Modules\Cms\Services\ContactMessage;

use Modules\Cms\Services\ContactMessage\Contracts\ContactMessageServiceInterface;
use Modules\Cms\Repositories\ContactMessage\Contracts\ContactMessageRepositoryInterface;
use Modules\Cms\Models\ContactMessage;
use Modules\Cms\DTOs\ContactMessage\ContactMessageData;

use Illuminate\Database\Eloquent\Collection;

class ContactMessageService implements ContactMessageServiceInterface
{
    public function __construct(
        private readonly ContactMessageRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?ContactMessage
    {
        return $this->repo->find($id);
    }

    public function create(ContactMessageData $data): ContactMessage
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, ContactMessageData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
