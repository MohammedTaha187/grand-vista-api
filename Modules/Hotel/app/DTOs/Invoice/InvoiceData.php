<?php

namespace Modules\Hotel\DTOs\Invoice;

use Spatie\LaravelData\Data;

class InvoiceData extends Data
{
    public function __construct(
        public readonly string $invoice_number,
        public readonly string $booking_id,
        public readonly string $user_id,
        public readonly string $issue_date,
        public readonly string $due_date,
        public readonly float $subtotal,
        public readonly float $tax_rate = 14.00,
        public readonly float $tax_amount,
        public readonly float $discount_amount = 0.00,
        public readonly float $total_amount,
        public readonly float $paid_amount = 0.00,
        public readonly float $balance_due,
        public readonly string $status = 'draft',
        public readonly ?string $payment_method = null,
        public readonly ?string $paid_at = null,
        public readonly ?string $pdf_url = null,
        public readonly ?string $notes = null,
    ) {}
}
