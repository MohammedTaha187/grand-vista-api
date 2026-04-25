<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'required', Rule::in(['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled', 'no_show'])],
            'check_in_date' => 'sometimes|required|date',
            'check_out_date' => 'sometimes|required|date|after:check_in_date',
            'guest_name' => 'sometimes|required|string|max:255',
            'guest_email' => 'sometimes|required|email|max:255',
            'guest_phone' => 'sometimes|required|string|max:20',
            'adults' => 'sometimes|required|integer|min:1',
            'children' => 'integer|min:0',
            'special_requests' => 'nullable|string',
        ];
    }
}
