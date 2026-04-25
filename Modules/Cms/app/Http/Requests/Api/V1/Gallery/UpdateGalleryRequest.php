<?php

namespace Modules\Cms\Http\Requests\Api\V1\Gallery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'category' => ['sometimes', 'required', Rule::in(['rooms', 'pool', 'dining', 'spa', 'beach', 'events', 'exterior', 'interior', 'wellness', 'wedding'])],
            'image_url' => 'sometimes|required|url',
            'thumbnail_url' => 'nullable|url',
            'caption' => 'nullable|string',
            'sort_order' => 'integer',
            'is_featured' => 'boolean',
        ];
    }
}
