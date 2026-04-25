<?php

namespace Modules\Hotel\Http\Requests\Api\V1\RoomAvailability;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomAvailabilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \Modules\Hotel\Models\RoomAvailability::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'room_id' => ['required', 'uuid', 'exists:rooms,id'],
            'date' => ['required', 'date'],
            'status' => ['required', 'in:available,booked,blocked,maintenance'],
            'booking_id' => ['nullable', 'uuid', 'exists:bookings,id'],
            'price_for_date' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
