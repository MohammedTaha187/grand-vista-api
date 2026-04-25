<?php

namespace Modules\Hotel\Http\Requests\Api\V1\BookingAddon;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingAddonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => ['sometimes', 'required', 'exists:bookings,id'],
            'addon_type' => ['sometimes', 'required', 'string'],
            'addon_name' => ['sometimes', 'required', 'string', 'max:255'],
            'quantity' => ['sometimes', 'required', 'integer'],
            'unit_price' => ['sometimes', 'required', 'numeric'],
            'total_price' => ['sometimes', 'required', 'numeric'],
        ];
    }
}
