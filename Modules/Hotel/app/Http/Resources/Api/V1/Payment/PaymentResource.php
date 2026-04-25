<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking_id' => $this->booking_id,
            'booking' => $this->whenLoaded('booking'),
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'),
            'amount' => (float) $this->amount,
            'currency' => $this->currency,
            'payment_method' => $this->payment_method,
            'payment_gateway' => $this->payment_gateway,
            'gateway_transaction_id' => $this->gateway_transaction_id,
            'status' => $this->status,
            'paid_at' => $this->paid_at,
            'refunded_at' => $this->refunded_at,
            'refund_amount' => $this->refund_amount ? (float) $this->refund_amount : null,
            'refund_reason' => $this->refund_reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
