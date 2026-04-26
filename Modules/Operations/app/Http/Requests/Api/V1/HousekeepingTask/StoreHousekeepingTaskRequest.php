<?php

namespace Modules\Operations\Http\Requests\Api\V1\HousekeepingTask;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreHousekeepingTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => 'required|uuid|exists:rooms,id',
            'assigned_to' => 'nullable|uuid|exists:users,id',
            'task_type' => ['required', Rule::in(['cleaning', 'maintenance', 'inspection', 'turndown', 'deep_clean', 'linen_change'])],
            'priority' => ['nullable', Rule::in(['low', 'medium', 'high', 'urgent'])],
            'status' => ['sometimes', 'required', Rule::in(['pending', 'in_progress', 'completed', 'cancelled'])],
            'scheduled_at' => 'required|date|after_or_equal:now',
            'notes' => 'nullable|string',
        ];
    }
}
