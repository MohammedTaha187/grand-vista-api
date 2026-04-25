<?php

namespace Modules\Cms\Services\BlogPost;

use Modules\Cms\Services\BlogPost\Contracts\BlogPostServiceInterface;
use Modules\Cms\Repositories\BlogPost\Contracts\BlogPostRepositoryInterface;
use Modules\Cms\Models\BlogPost;
use Modules\Cms\DTOs\BlogPost\BlogPostData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class BlogPostService implements BlogPostServiceInterface
{
    public function __construct(
        private readonly BlogPostRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(BlogPost::class)
            ->allowedFilters(...[
                'category',
                'author_id',
                'is_published',
                AllowedFilter::partial('title'),
                AllowedFilter::partial('content'),
                AllowedFilter::callback('published_from', function ($query, $value) {
                    $query->where('published_at', '>=', $value);
                }),
                AllowedFilter::callback('published_to', function ($query, $value) {
                    $query->where('published_at', '<=', $value);
                }),
            ])
            ->allowedSorts(...['title', 'published_at', 'created_at'])
            ->defaultSort('-created_at')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?BlogPost
    {
        return $this->repo->find($id);
    }

    public function create(BlogPostData $data): BlogPost
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->create($payload);
    }

    public function update(string $id, BlogPostData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
