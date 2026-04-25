<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\PaymentProviderInterface;
use Illuminate\Support\Facades\Http;

class PaymobProvider implements PaymentProviderInterface
{
    private string $apiKey;
    private string $integrationId;
    private string $iframeId;
    private string $baseUrl = 'https://accept.paymob.com/api';

    public function __construct()
    {
        $this->apiKey = config('services.paymob.api_key');
        $this->integrationId = config('services.paymob.integration_id');
        $this->iframeId = config('services.paymob.iframe_id');
    }

    public function initialize(array $data): array
    {
        // 1. Authentication Request
        $authResponse = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => $this->apiKey
        ]);
        $token = $authResponse->json('token');

        // 2. Order Registration
        $orderResponse = Http::post("{$this->baseUrl}/ecommerce/orders", [
            'auth_token' => $token,
            'delivery_needed' => 'false',
            'amount_cents' => $data['amount'] * 100,
            'currency' => $data['currency'] ?? 'EGP',
            'items' => [],
        ]);
        $orderId = $orderResponse->json('id');

        // 3. Payment Key Request
        $keyResponse = Http::post("{$this->baseUrl}/acceptance/payment_keys", [
            'auth_token' => $token,
            'amount_cents' => $data['amount'] * 100,
            'expiration' => 3600,
            'order_id' => $orderId,
            'billing_data' => [
                'apartment' => 'NA',
                'email' => $data['customer_email'] ?? 'test@example.com',
                'floor' => 'NA',
                'first_name' => $data['customer_name'] ?? 'Guest',
                'street' => 'NA',
                'building' => 'NA',
                'phone_number' => $data['customer_phone'] ?? '0123456789',
                'shipping_method' => 'NA',
                'postal_code' => 'NA',
                'city' => 'NA',
                'country' => 'NA',
                'last_name' => 'User',
                'state' => 'NA',
            ],
            'currency' => $data['currency'] ?? 'EGP',
            'integration_id' => $this->integrationId,
        ]);
        $paymentKey = $keyResponse->json('token');

        return [
            'payment_id' => $paymentKey,
            'redirect_url' => "https://accept.paymob.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$paymentKey}",
        ];
    }

    public function handleCallback(array $requestData): array
    {
        if ($requestData['success'] == 'true') {
            return [
                'status' => 'success',
                'transaction_id' => $requestData['id'],
            ];
        }
        return ['status' => 'failed'];
    }

    public function refund(string $transactionId, float $amount): bool
    {
        return true;
    }
}
