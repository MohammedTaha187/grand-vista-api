<?php

namespace App\Services\Payment\Contracts;

interface PaymentProviderInterface
{
    /**
     * Initialize a payment request.
     */
    public function initialize(array $data): array;

    /**
     * Handle callback from the payment provider.
     */
    public function handleCallback(array $requestData): array;

    /**
     * Refund a payment.
     */
    public function refund(string $transactionId, float $amount): bool;
}
