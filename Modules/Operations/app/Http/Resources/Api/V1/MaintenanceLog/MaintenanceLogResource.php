<?php

namespace Modules\Operations\Http\Resources\Api\V1\MaintenanceLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'room_id' => $this->room_id,
            'room' => $this->whenLoaded('room'),
            'reported_by' => $this->reported_by,
            'reporter' => $this->whenLoaded('reporter'),
            'issue_type' => $this->issue_type,
            'description' => $this->description,
            'severity' => $this->severity,
            'status' => $this->status,
            'resolved_at' => $this->resolved_at,
            'resolved_by' => $this->resolved_by,
            'resolver' => $this->whenLoaded('resolver'),
            'cost' => $this->cost ? (float) $this->cost : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
