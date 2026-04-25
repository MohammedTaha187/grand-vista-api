<?php

namespace Modules\Cms\Services\BlogPost\Contracts;

use Modules\Cms\Models\BlogPost;
use Modules\Cms\DTOs\BlogPost\BlogPostData;
use Illuminate\Pagination\LengthAwarePaginator;

interface BlogPostServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?BlogPost;

    public function create(BlogPostData $data): BlogPost;

    public function update(string $id, BlogPostData $data): bool;

    public function delete(string $id): bool;
}
