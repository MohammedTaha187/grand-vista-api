<?php

namespace Modules\Hotel\app\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Services\Payment\PaymentManager;
use Illuminate\Http\Request;
use Modules\Hotel\Models\Booking;

class PaymentController extends Controller
{
    public function __construct(protected PaymentManager $paymentManager) {}

    /**
     * @OA\Post(
     *     path="/api/v1/hotel/client/payments/pay",
     *     tags={"Payments"},
     *     summary="Initialize payment for a booking",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="booking_id", type="string"),
     *             @OA\Property(property="method", type="string", enum={"stripe", "paypal", "paymob", "kashier"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Redirect URL generated")
     * )
     */
    public function pay(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'method' => 'required|in:stripe,paypal,paymob,kashier',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        $paymentProvider = $this->paymentManager->driver($request->method);

        $result = $paymentProvider->initialize([
            'amount' => $booking->total_price,
            'currency' => 'USD',
            'booking_id' => $booking->id,
            'description' => "Payment for Booking #{$booking->id}",
            'success_url' => url("/api/v1/hotel/client/payments/callback/{$request->method}?status=success&booking_id={$booking->id}"),
            'cancel_url' => url("/api/v1/hotel/client/payments/callback/{$request->method}?status=cancel&booking_id={$booking->id}"),
            'customer_email' => $request->user()->email,
            'customer_name' => $request->user()->name,
        ]);

        return $this->successResponse($result, 'Payment initialized');
    }

    public function callback(Request $request, string $method)
    {
        $paymentProvider = $this->paymentManager->driver($method);
        $result = $paymentProvider->handleCallback($request->all());

        $bookingId = $request->query('booking_id');
        $booking = Booking::with('user')->findOrFail($bookingId);

        if ($result['status'] === 'success') {
            $booking->update(['status' => 'confirmed']);
            
            // Send Success Email
            \Illuminate\Support\Facades\Mail::to($booking->user->email)
                ->send(new \App\Mail\PaymentStatusMail($booking, 'success', $result['transaction_id']));

            return $this->successResponse($result, 'Payment successful and booking confirmed');
        }

        // Send Failed Email
        \Illuminate\Support\Facades\Mail::to($booking->user->email)
            ->send(new \App\Mail\PaymentStatusMail($booking, 'failed'));

        return $this->errorResponse('Payment failed', 422);
    }
}
