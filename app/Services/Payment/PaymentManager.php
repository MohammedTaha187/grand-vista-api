<?php

namespace App\Services\Payment;

use App\Services\Payment\Contracts\PaymentProviderInterface;
use App\Services\Payment\Providers\StripeProvider;
use App\Services\Payment\Providers\PayPalProvider;
use App\Services\Payment\Providers\PaymobProvider;
use App\Services\Payment\Providers\KashierProvider;
use Exception;

class PaymentManager
{
    public function driver(string $driver): PaymentProviderInterface
    {
        return match ($driver) {
            'stripe' => new StripeProvider(),
            'paypal' => new PayPalProvider(),
            'paymob' => new PaymobProvider(),
            'kashier' => new KashierProvider(),
            default => throw new Exception("Unsupported payment driver: {$driver}"),
        };
    }
}
