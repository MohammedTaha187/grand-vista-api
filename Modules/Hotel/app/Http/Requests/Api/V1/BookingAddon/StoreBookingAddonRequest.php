<?php

namespace Modules\Hotel\Http\Requests\Api\V1\BookingAddon;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingAddonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \Modules\Hotel\Models\BookingAddon::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'booking_id' => ['required', 'exists:bookings,id'],
            'addon_type' => ['required', 'string'],
            'addon_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
        ];
    }
}
