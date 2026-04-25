<?php

namespace Modules\Hotel\Http\Resources\Api\V1\Invoice;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Hotel\Http\Resources\Api\V1\InvoiceItem\InvoiceItemResource;

class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'booking_id' => $this->booking_id,
            'booking' => $this->whenLoaded('booking'),
            'user_id' => $this->user_id,
            'user' => $this->whenLoaded('user'),
            'issue_date' => $this->issue_date,
            'due_date' => $this->due_date,
            'subtotal' => (float) $this->subtotal,
            'tax_rate' => (float) $this->tax_rate,
            'tax_amount' => (float) $this->tax_amount,
            'discount_amount' => (float) $this->discount_amount,
            'total_amount' => (float) $this->total_amount,
            'paid_amount' => (float) $this->paid_amount,
            'balance_due' => (float) $this->balance_due,
            'status' => $this->status,
            'payment_method' => $this->payment_method,
            'paid_at' => $this->paid_at,
            'pdf_url' => $this->pdf_url,
            'notes' => $this->notes,
            'items' => InvoiceItemResource::collection($this->whenLoaded('items')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
