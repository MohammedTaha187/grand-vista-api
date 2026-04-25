<?php

namespace Modules\Cms\Services\Faq;

use Modules\Cms\Services\Faq\Contracts\FaqServiceInterface;
use Modules\Cms\Repositories\Faq\Contracts\FaqRepositoryInterface;
use Modules\Cms\Models\Faq;
use Modules\Cms\DTOs\Faq\FaqData;

use Illuminate\Database\Eloquent\Collection;

class FaqService implements FaqServiceInterface
{
    public function __construct(
        private readonly FaqRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?Faq
    {
        return $this->repo->find($id);
    }

    public function create(FaqData $data): Faq
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, FaqData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
