<?php

namespace Modules\Cms\Http\Requests\Api\V1\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'guest_name' => 'sometimes|required|string|max:255',
            'guest_country' => 'sometimes|required|string|max:255',
            'guest_avatar' => 'nullable|string',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'sometimes|required|string',
            'room_type_id' => 'nullable|uuid|exists:room_types,id',
            'stay_dates' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_approved' => 'boolean',
        ];
    }
}
