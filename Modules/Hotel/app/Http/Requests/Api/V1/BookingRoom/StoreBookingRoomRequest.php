<?php

namespace Modules\Hotel\Http\Requests\Api\V1\BookingRoom;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRoomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \Modules\Hotel\Models\BookingRoom::class);
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
            'room_id' => ['exists:rooms,id'],
            'room_type_id' => ['exists:room_types,id'],
            'price_per_night' => ['numeric'],
            'nights' => ['integer'],
            'subtotal' => ['numeric'],
        ];
    }
}
