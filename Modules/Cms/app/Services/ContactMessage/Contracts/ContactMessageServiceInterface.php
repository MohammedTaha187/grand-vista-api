<?php

namespace Modules\Cms\Services\ContactMessage\Contracts;

use Modules\Cms\Models\ContactMessage;
use Modules\Cms\DTOs\ContactMessage\ContactMessageData;
use Illuminate\Database\Eloquent\Collection;

interface ContactMessageServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?ContactMessage;

    public function create(ContactMessageData $data): ContactMessage;

    public function update(string $id, ContactMessageData $data): bool;

    public function delete(string $id): bool;
}
