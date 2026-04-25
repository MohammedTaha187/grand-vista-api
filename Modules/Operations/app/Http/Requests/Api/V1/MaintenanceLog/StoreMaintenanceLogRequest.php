<?php

namespace Modules\Operations\Http\Requests\Api\V1\MaintenanceLog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMaintenanceLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => 'required|uuid|exists:rooms,id',
            'reported_by' => 'required|uuid|exists:users,id',
            'issue_type' => ['required', Rule::in(['plumbing', 'electrical', 'hvac', 'furniture', 'appliance', 'structural', 'other'])],
            'description' => 'required|string',
            'severity' => ['nullable', Rule::in(['minor', 'moderate', 'major', 'critical'])],
            'status' => ['nullable', Rule::in(['reported', 'in_progress', 'resolved', 'cancelled'])],
            'resolved_at' => 'nullable|date',
            'resolved_by' => 'nullable|uuid|exists:users,id',
            'cost' => 'nullable|numeric|min:0',
        ];
    }
}
