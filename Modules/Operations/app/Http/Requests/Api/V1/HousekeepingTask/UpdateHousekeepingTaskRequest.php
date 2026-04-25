<?php

namespace Modules\Operations\Http\Requests\Api\V1\HousekeepingTask;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHousekeepingTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assigned_to' => 'nullable|uuid|exists:users,id',
            'status' => ['sometimes', 'required', Rule::in(['pending', 'in_progress', 'completed', 'cancelled'])],
            'priority' => ['sometimes', 'required', Rule::in(['low', 'medium', 'high', 'urgent'])],
            'scheduled_at' => 'sometimes|required|date',
            'completed_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ];
    }
}
