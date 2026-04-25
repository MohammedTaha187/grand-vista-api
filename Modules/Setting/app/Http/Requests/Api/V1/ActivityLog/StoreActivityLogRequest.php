<?php

namespace Modules\Setting\Http\Requests\Api\V1\ActivityLog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreActivityLogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \Modules\Setting\Models\ActivityLog::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'nullable|uuid|exists:users,id',
            'booking_id' => 'nullable|uuid|exists:bookings,id',
            'action' => ['required', Rule::in(['created', 'updated', 'deleted', 'checked_in', 'checked_out', 'cancelled', 'paid', 'refunded', 'viewed'])],
            'entity_type' => 'required|string|max:255',
            'entity_id' => 'required|uuid',
            'description' => 'required|string',
            'ip_address' => 'nullable|string|max:255',
            'user_agent' => 'nullable|string',
        ];
    }
}
