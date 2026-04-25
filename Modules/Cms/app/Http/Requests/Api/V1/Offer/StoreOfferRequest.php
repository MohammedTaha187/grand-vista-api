<?php

namespace Modules\Cms\Http\Requests\Api\V1\Offer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', Rule::unique('offers', 'slug')],
            'description' => 'required|string',
            'terms_conditions' => 'nullable|string',
            'discount_type' => ['required', Rule::in(['percentage', 'fixed_amount', 'free_night'])],
            'discount_value' => 'required|numeric|min:0',
            'min_nights' => 'nullable|integer|min:1',
            'max_nights' => 'nullable|integer|min:1',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'applicable_room_types' => 'nullable|array',
            'is_active' => 'boolean',
            'image' => 'nullable|string',
        ];
    }
}
