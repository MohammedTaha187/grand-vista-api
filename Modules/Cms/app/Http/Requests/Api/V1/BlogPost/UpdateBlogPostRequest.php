<?php

namespace Modules\Cms\Http\Requests\Api\V1\BlogPost;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $blogPost = $this->route('blog_post');
        $id = is_object($blogPost) ? $blogPost->id : $blogPost;

        return [
            'title' => 'sometimes|required|string|max:255',
            'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('blog_posts', 'slug')->ignore($id)],
            'excerpt' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            'featured_image' => 'nullable|string',
            'author_id' => 'sometimes|required|uuid|exists:users,id',
            'category' => ['sometimes', 'required', Rule::in(['travel_tips', 'hotel_news', 'local_guide', 'events', 'wellness', 'dining'])],
            'tags' => 'nullable|array',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ];
    }
}
