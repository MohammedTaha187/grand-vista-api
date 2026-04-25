<?php

namespace Modules\Cms\Http\Resources\Api\V1\BlogPost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'media' => [
                'featured_image' => $this->featured_image_url,
            ],
            'author' => [
                'id' => $this->author_id,
                'name' => $this->user ? $this->user->name : null,
            ],
            'category' => $this->category,
            'tags' => $this->tags,
            'status' => [
                'is_published' => (bool) $this->is_published,
                'published_at' => $this->published_at,
            ],
            'seo' => $this->seo_metadata,
            'analytics' => [
                'views_count' => $this->views_count,
            ],
            'timestamps' => [
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
        ];
    }
}
