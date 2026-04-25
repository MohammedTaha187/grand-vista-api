<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\PaymentProviderInterface;

class KashierProvider implements PaymentProviderInterface
{
    private string $merchantId;
    private string $apiKey;
    private string $mode;

    public function __construct()
    {
        $this->merchantId = config('services.kashier.merchant_id');
        $this->apiKey = config('services.kashier.api_key');
        $this->mode = config('services.kashier.mode', 'sandbox');
    }

    public function initialize(array $data): array
    {
        $baseUrl = $this->mode == 'live' 
            ? "https://checkout.kashier.com" 
            : "https://checkout.kashier.com"; // Kashier often uses the same URL with different keys

        $amount = $data['amount'];
        $currency = $data['currency'] ?? 'EGP';
        $orderId = $data['booking_id'];
        
        $path = "/?merchantId={$this->merchantId}&amount={$amount}&currency={$currency}&orderId={$orderId}&type=external";
        
        // Hash Generation (Simplified for now)
        $hash = hash_hmac('sha256', "{$this->merchantId}{$orderId}{$amount}{$currency}", $this->apiKey);
        $redirectUrl = "{$baseUrl}{$path}&hash={$hash}";

        return [
            'payment_id' => $orderId,
            'redirect_url' => $redirectUrl,
        ];
    }

    public function handleCallback(array $requestData): array
    {
        if ($requestData['paymentStatus'] == 'SUCCESS') {
            return [
                'status' => 'success',
                'transaction_id' => $requestData['transactionId'],
            ];
        }
        return ['status' => 'failed'];
    }

    public function refund(string $transactionId, float $amount): bool
    {
        return true;
    }
}
