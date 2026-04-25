<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'booking_id' => 'required|uuid|exists:bookings,id',
            'room_id' => 'required|uuid|exists:rooms,id',
            'rating' => 'required|integer|min:1|max:5',
            'cleanliness_rating' => 'nullable|integer|min:1|max:5',
            'service_rating' => 'nullable|integer|min:1|max:5',
            'comfort_rating' => 'nullable|integer|min:1|max:5',
            'location_rating' => 'nullable|integer|min:1|max:5',
            'value_rating' => 'nullable|integer|min:1|max:5',
            'title' => 'nullable|string|max:255',
            'comment' => 'required|string',
        ];
    }
}
