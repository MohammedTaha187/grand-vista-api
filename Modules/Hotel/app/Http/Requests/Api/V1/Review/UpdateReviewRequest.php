<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Review;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|uuid|exists:users,id',
            'booking_id' => 'sometimes|required|uuid|exists:bookings,id',
            'room_id' => 'sometimes|required|uuid|exists:rooms,id',
            'rating' => 'sometimes|required|integer|min:1|max:5',
            'comment' => 'sometimes|required|string',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'admin_response' => 'nullable|string',
        ];
    }
}
