<?php

namespace Modules\Hotel\Http\Requests\Api\V1\GuestPreference;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestPreferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \Modules\Hotel\Models\GuestPreference::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'preferred_room_type_id' => ['nullable', 'uuid', 'exists:room_types,id'],
            'preferred_floor' => ['nullable', 'integer'],
            'preferred_bed_type' => ['nullable', 'string'],
            'dietary_requirements' => ['nullable', 'string'],
            'allergies' => ['nullable', 'array'],
            'special_needs' => ['nullable', 'string'],
            'preferred_language' => ['nullable', 'string', 'size:2'],
        ];
    }
}
