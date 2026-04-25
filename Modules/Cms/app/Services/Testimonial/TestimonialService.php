<?php

namespace Modules\Cms\Services\Testimonial;

use Modules\Cms\Services\Testimonial\Contracts\TestimonialServiceInterface;
use Modules\Cms\Repositories\Testimonial\Contracts\TestimonialRepositoryInterface;
use Modules\Cms\Models\Testimonial;
use Modules\Cms\DTOs\Testimonial\TestimonialData;

use Illuminate\Database\Eloquent\Collection;

class TestimonialService implements TestimonialServiceInterface
{
    public function __construct(
        private readonly TestimonialRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?Testimonial
    {
        return $this->repo->find($id);
    }

    public function create(TestimonialData $data): Testimonial
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, TestimonialData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
