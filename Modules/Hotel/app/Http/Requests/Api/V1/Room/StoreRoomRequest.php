<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_type_id' => 'required|uuid|exists:room_types,id',
            'room_number' => ['required', 'string', 'max:255', Rule::unique('rooms', 'room_number')],
            'floor' => 'nullable|integer',
            'status' => ['nullable', Rule::in(['available', 'occupied', 'maintenance', 'reserved', 'cleaning', 'out_of_order'])],
            'price_override' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
