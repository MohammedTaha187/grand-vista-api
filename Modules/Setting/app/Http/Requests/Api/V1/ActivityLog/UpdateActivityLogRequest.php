<?php

namespace Modules\Setting\Http\Requests\Api\V1\ActivityLog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateActivityLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('activity_log'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'sometimes|nullable|uuid|exists:users,id',
            'booking_id' => 'sometimes|nullable|uuid|exists:bookings,id',
            'action' => ['sometimes', 'required', Rule::in(['created', 'updated', 'deleted', 'checked_in', 'checked_out', 'cancelled', 'paid', 'refunded', 'viewed'])],
            'entity_type' => 'sometimes|required|string|max:255',
            'entity_id' => 'sometimes|required|uuid',
            'description' => 'sometimes|required|string',
            'ip_address' => 'sometimes|nullable|string|max:255',
            'user_agent' => 'sometimes|nullable|string',
        ];
    }
}
