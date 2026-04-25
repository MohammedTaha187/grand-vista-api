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
            'status' => ['sometimes', 'required', Rule::in(['reported', 'in_progress', 'resolved', 'cancelled'])],
            'severity' => ['sometimes', 'required', Rule::in(['minor', 'moderate', 'major', 'critical'])],
            'resolved_at' => 'nullable|date',
            'resolved_by' => 'nullable|uuid|exists:users,id',
            'cost' => 'nullable|numeric|min:0',
            'description' => 'sometimes|required|string',
        ];
    }
}
