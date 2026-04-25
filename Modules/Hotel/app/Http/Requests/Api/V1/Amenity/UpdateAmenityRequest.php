<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Amenity;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAmenityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $amenity = $this->route('amenity');
        $id = is_object($amenity) ? $amenity->id : $amenity;

        return [
            'name' => 'sometimes|required|string|max:255',
            'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('amenities', 'slug')->ignore($id)],
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => ['sometimes', 'required', Rule::in(['room', 'bathroom', 'technology', 'comfort', 'dining', 'wellness', 'recreation', 'business'])],
            'is_premium' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
