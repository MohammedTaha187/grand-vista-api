<?php

namespace Modules\Cms\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Cms\Database\Factories\BlogPost\BlogPostFactory;
use Illuminate\Support\Facades\Storage;

#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class BlogPost extends Model 
{
    /** @use HasFactory<BlogPostFactory> */
    use HasFactory, HasUuids;

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'views_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'author_id', 'id');
    }

    /**
     * Get the full URL for the featured image.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? Storage::url($this->featured_image) : null;
    }

    /**
     * Scope for SEO metadata.
     */
    public function getSeoMetadataAttribute(): array
    {
        return [
            'title' => $this->meta_title ?? $this->title,
            'description' => $this->meta_description ?? substr(strip_tags($this->content), 0, 160),
            'keywords' => $this->meta_keywords,
        ];
    }
}
