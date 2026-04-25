<?php

namespace Modules\Cms\Http\Requests\Api\V1\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => ['required', Rule::in(['booking', 'rooms', 'dining', 'spa', 'payment', 'general', 'policies'])],
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
