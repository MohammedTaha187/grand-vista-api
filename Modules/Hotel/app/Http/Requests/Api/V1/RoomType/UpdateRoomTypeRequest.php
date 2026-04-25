<?php

namespace Modules\Hotel\Http\Requests\Api\V1\RoomType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roomType = $this->route('room_type');
        $id = is_object($roomType) ? $roomType->id : $roomType;

        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('room_types', 'slug')->ignore($id)],
            'base_price' => 'sometimes|required|numeric|min:0',
            'capacity_adults' => 'sometimes|required|integer|min:1',
            'capacity_children' => 'sometimes|required|integer|min:0',
            'size_sqm' => 'sometimes|required|integer|min:1',
            'bed_type' => ['sometimes', 'required', Rule::in(['single', 'double', 'king', 'queen', 'twin'])],
            'view_type' => ['sometimes', 'required', Rule::in(['city', 'garden', 'mountain', 'pool', 'ocean'])],
            'images' => 'nullable|array',
            'amenities' => 'nullable|array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
