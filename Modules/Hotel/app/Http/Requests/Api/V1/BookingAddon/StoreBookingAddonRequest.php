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
            'booking_id' => ['exists:bookings,id'],
            'addon_type' => [''],
            'addon_name' => ['string', 'max:255'],
            'quantity' => ['integer'],
            'unit_price' => ['numeric'],
            'total_price' => ['numeric'],
        ];
    }
}
