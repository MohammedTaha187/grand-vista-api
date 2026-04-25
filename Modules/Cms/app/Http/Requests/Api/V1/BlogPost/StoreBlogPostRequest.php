<?php

namespace Modules\Cms\Http\Requests\Api\V1\BlogPost;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Simplified for now, or use $this->user()->can(...)
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('blog_posts', 'slug')],
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'author_id' => 'required|uuid|exists:users,id',
            'category' => ['required', Rule::in(['travel_tips', 'hotel_news', 'local_guide', 'events', 'wellness', 'dining'])],
            'tags' => 'nullable|array',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];
    }
}
