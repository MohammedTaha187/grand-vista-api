<?php

namespace Modules\Cms\Http\Requests\Api\V1\ContactMessage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'required', Rule::in(['new', 'read', 'replied', 'archived'])],
            'message' => 'sometimes|required|string', // Although usually contact messages aren't edited by user
        ];
    }
}
