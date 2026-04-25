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
            'issue_type' => ['required', Rule::in(['plumbing', 'electrical', 'hvac', 'furniture', 'appliance', 'structural', 'other'])],
            'description' => 'required|string',
            'severity' => ['nullable', Rule::in(['minor', 'moderate', 'major', 'critical'])],
        ];
    }
}
