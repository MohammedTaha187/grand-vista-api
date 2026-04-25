<?php

namespace Modules\Cms\Services\Faq\Contracts;

use Modules\Cms\Models\Faq;
use Modules\Cms\DTOs\Faq\FaqData;
use Illuminate\Database\Eloquent\Collection;

interface FaqServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?Faq;

    public function create(FaqData $data): Faq;

    public function update(string $id, FaqData $data): bool;

    public function delete(string $id): bool;
}
