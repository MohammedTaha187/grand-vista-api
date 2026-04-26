<?php

namespace Modules\Operations\Http\Requests\Api\V1\MaintenanceLog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMaintenanceLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => 'sometimes|required|uuid|exists:rooms,id',
            'reported_by' => 'sometimes|required|uuid|exists:users,id',
            'issue_type' => ['sometimes', 'required', Rule::in(['plumbing', 'electrical', 'hvac', 'furniture', 'appliance', 'structural', 'other'])],
            'description' => 'sometimes|required|string',
            'severity' => ['sometimes', 'required', Rule::in(['minor', 'moderate', 'major', 'critical'])],
            'status' => ['sometimes', 'required', Rule::in(['reported', 'in_progress', 'resolved', 'cancelled'])],
            'resolved_at' => 'nullable|date',
            'resolved_by' => 'nullable|uuid|exists:users,id',
            'cost' => 'nullable|numeric|min:0',
        ];
    }
}
