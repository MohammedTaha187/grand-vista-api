<?php

namespace Modules\Operations\Http\Resources\Api\V1\HousekeepingTask;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HousekeepingTaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'room' => $this->whenLoaded('room'),
            'assigned_to' => $this->assigned_to,
            'assigned_user' => $this->whenLoaded('assignedUser'),
            'task_type' => $this->task_type,
            'priority' => $this->priority,
            'status' => $this->status,
            'scheduled_at' => $this->scheduled_at,
            'completed_at' => $this->completed_at,
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
