<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $room = $this->route('room');
        $id = is_object($room) ? $room->id : $room;

        return [
            'room_type_id' => 'sometimes|required|uuid|exists:room_types,id',
            'room_number' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('rooms', 'room_number')->ignore($id)],
            'floor' => 'nullable|integer',
            'status' => ['sometimes', 'required', Rule::in(['available', 'occupied', 'maintenance', 'reserved', 'cleaning', 'out_of_order'])],
            'price_override' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ];
    }
}
