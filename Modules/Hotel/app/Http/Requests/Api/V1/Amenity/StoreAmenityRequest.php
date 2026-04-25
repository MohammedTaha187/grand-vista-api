<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Amenity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAmenityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('amenities', 'slug')],
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => ['required', Rule::in(['room', 'bathroom', 'technology', 'comfort', 'dining', 'wellness', 'recreation', 'business'])],
            'is_premium' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
