<?php

namespace Modules\Cms\Services\Testimonial\Contracts;

use Modules\Cms\Models\Testimonial;
use Modules\Cms\DTOs\Testimonial\TestimonialData;
use Illuminate\Database\Eloquent\Collection;

interface TestimonialServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?Testimonial;

    public function create(TestimonialData $data): Testimonial;

    public function update(string $id, TestimonialData $data): bool;

    public function delete(string $id): bool;
}
