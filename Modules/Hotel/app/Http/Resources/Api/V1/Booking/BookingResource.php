<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Booking;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Hotel\Http\Resources\Api\V1\Room\RoomResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking_reference' => $this->booking_reference,
            'status' => $this->status,
            'guest' => [
                'name' => $this->guest_name,
                'email' => $this->guest_email,
                'phone' => $this->guest_phone,
            ],
            'stay' => [
                'check_in' => $this->check_in_date,
                'check_out' => $this->check_out_date,
                'nights' => $this->nights,
                'actual_check_in' => $this->actual_check_in,
                'actual_check_out' => $this->actual_check_out,
            ],
            'occupancy' => [
                'adults' => $this->adults,
                'children' => $this->children,
            ],
            'financials' => [
                'total_amount' => (float)$this->total_amount,
                'tax_amount' => (float)$this->tax_amount,
                'paid_amount' => (float)$this->paid_amount,
                'balance_due' => (float)$this->balance_due,
                'refunded_amount' => (float)$this->refunded_amount,
                'currency' => $this->currency,
                'payment_status' => $this->payment_status,
            ],
            'metadata' => [
                'cancellation_reason' => $this->cancellation_reason,
                'cancelled_at' => $this->cancelled_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'rooms' => RoomResource::collection($this->whenLoaded('bookingRooms')),
        ];
    }
}
