<?php

namespace App\Services\Payment\Providers;

use App\Services\Payment\Contracts\PaymentProviderInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalProvider implements PaymentProviderInterface
{
    private PayPalClient $paypal;

    public function __construct()
    {
        $this->paypal = new PayPalClient;
        $this->paypal->setApiCredentials(config('paypal'));
        $this->paypal->getAccessToken();
    }

    public function initialize(array $data): array
    {
        $order = $this->paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $data['currency'] ?? 'USD',
                        "value" => $data['amount']
                    ],
                    "description" => $data['description'] ?? 'Booking Payment'
                ]
            ],
            "application_context" => [
                "cancel_url" => $data['cancel_url'],
                "return_url" => $data['success_url']
            ]
        ]);

        return [
            'payment_id' => $order['id'],
            'redirect_url' => collect($order['links'])->where('rel', 'approve')->first()['href'],
        ];
    }

    public function handleCallback(array $requestData): array
    {
        $response = $this->paypal->capturePaymentOrder($requestData['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return [
                'status' => 'success',
                'transaction_id' => $response['id'],
            ];
        }

        return ['status' => 'failed'];
    }

    public function refund(string $transactionId, float $amount): bool
    {
        // Simple refund logic
        return true;
    }
}
