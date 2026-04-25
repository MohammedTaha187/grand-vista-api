<?php

namespace Modules\Hotel\DTOs\Payment;

use Spatie\LaravelData\Data;

class PaymentData extends Data
{
    public function __construct(
        public readonly string $booking_id,
        public readonly string $user_id,
        public readonly float $amount,
        public readonly string $currency = 'USD',
        public readonly string $payment_method,
        public readonly string $payment_gateway = 'manual',
        public readonly ?string $gateway_transaction_id = null,
        public readonly ?array $gateway_response = null,
        public readonly string $status = 'pending',
        public readonly ?string $paid_at = null,
    ) {}
}
