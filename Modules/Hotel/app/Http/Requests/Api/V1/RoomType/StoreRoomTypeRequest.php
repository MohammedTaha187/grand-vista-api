<?php

namespace Modules\Hotel\Http\Requests\Api\V1\RoomType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoomTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'slug' => ['required', 'string', 'max:255', Rule::unique('room_types', 'slug')],
            'base_price' => 'required|numeric|min:0',
            'capacity_adults' => 'required|integer|min:1',
            'capacity_children' => 'required|integer|min:0',
            'size_sqm' => 'required|integer|min:1',
            'bed_type' => ['required', Rule::in(['single', 'double', 'king', 'queen', 'twin'])],
            'view_type' => ['required', Rule::in(['city', 'garden', 'mountain', 'pool', 'ocean'])],
            'images' => 'nullable|array',
            'amenities' => 'nullable|array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
