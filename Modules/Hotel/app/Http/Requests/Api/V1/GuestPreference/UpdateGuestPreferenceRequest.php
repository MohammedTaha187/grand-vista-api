<?php

namespace Modules\Hotel\Http\Requests\Api\V1\GuestPreference;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuestPreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|required|uuid|exists:users,id',
            'preferred_room_type_id' => 'nullable|uuid|exists:room_types,id',
            'preferred_floor' => 'nullable|integer',
            'preferred_bed_type' => 'nullable|string',
            'dietary_requirements' => 'nullable|string',
            'allergies' => 'nullable|array',
            'special_needs' => 'nullable|string',
            'preferred_language' => 'sometimes|required|string|size:2',
        ];
    }
}
