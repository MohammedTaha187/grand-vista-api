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
        return $this->user()->can('update', $this->route('bookingAddon'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => ['sometimes', 'exists:bookings,id'],
            'addon_type' => ['sometimes'],
            'addon_name' => ['sometimes', 'string', 'max:255'],
            'quantity' => ['sometimes', 'integer'],
            'unit_price' => ['sometimes', 'numeric'],
            'total_price' => ['sometimes', 'numeric'],
        ];
    }
}
