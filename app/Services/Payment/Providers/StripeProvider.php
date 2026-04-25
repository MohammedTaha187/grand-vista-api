<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\PaymentProviderInterface;
use Stripe\StripeClient;

class StripeProvider implements PaymentProviderInterface
{
    private StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function initialize(array $data): array
    {
        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $data['currency'] ?? 'usd',
                    'product_data' => [
                        'name' => $data['description'] ?? 'Booking Payment',
                    ],
                    'unit_amount' => $data['amount'] * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $data['success_url'],
            'cancel_url' => $data['cancel_url'],
            'metadata' => [
                'booking_id' => $data['booking_id'],
            ],
        ]);

        return [
            'payment_id' => $session->id,
            'redirect_url' => $session->url,
        ];
    }

    public function handleCallback(array $requestData): array
    {
        // Simple callback logic for now
        return [
            'status' => 'success',
            'transaction_id' => $requestData['session_id'],
        ];
    }

    public function refund(string $transactionId, float $amount): bool
    {
        $this->stripe->refunds->create([
            'payment_intent' => $transactionId,
            'amount' => $amount * 100,
        ]);
        return true;
    }
}
