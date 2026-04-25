<?php

namespace Modules\Hotel\Http\Requests\Api\V1\BookingRoom;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('bookingRoom'));
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
            'room_id' => ['sometimes', 'exists:rooms,id'],
            'room_type_id' => ['sometimes', 'exists:room_types,id'],
            'price_per_night' => ['sometimes', 'numeric'],
            'nights' => ['sometimes', 'integer'],
            'subtotal' => ['sometimes', 'numeric'],
        ];
    }
}
