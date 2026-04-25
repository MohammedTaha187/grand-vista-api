<?php

namespace Modules\Cms\Http\Requests\Api\V1\Offer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOfferRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $offer = $this->route('offer');
        $id = is_object($offer) ? $offer->id : $offer;

        return [
            'title' => 'sometimes|required|string|max:255',
            'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('offers', 'slug')->ignore($id)],
            'description' => 'sometimes|required|string',
            'terms_conditions' => 'nullable|string',
            'discount_type' => ['sometimes', 'required', Rule::in(['percentage', 'fixed_amount', 'free_night'])],
            'discount_value' => 'sometimes|required|numeric|min:0',
            'min_nights' => 'nullable|integer|min:1',
            'max_nights' => 'nullable|integer|min:1',
            'valid_from' => 'sometimes|required|date',
            'valid_until' => 'sometimes|required|date|after_or_equal:valid_from',
            'applicable_room_types' => 'nullable|array',
            'is_active' => 'boolean',
            'image' => 'nullable|string',
        ];
    }
}
