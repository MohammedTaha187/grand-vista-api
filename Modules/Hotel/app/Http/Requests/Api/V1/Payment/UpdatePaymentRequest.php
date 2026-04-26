<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'booking_id' => 'sometimes|required|uuid|exists:bookings,id',
            'user_id' => 'sometimes|required|uuid|exists:users,id',
            'amount' => 'sometimes|required|numeric|min:0',
            'currency' => 'sometimes|string|size:3',
            'payment_method' => 'sometimes|required|string',
            'payment_gateway' => ['nullable', Rule::in(['stripe', 'paypal', 'manual'])],
            'gateway_transaction_id' => 'nullable|string',
            'status' => ['sometimes', 'required', Rule::in(['pending', 'completed', 'failed', 'refunded', 'partially_refunded'])],
            'refund_amount' => 'nullable|numeric|min:0',
            'refund_reason' => 'nullable|string',
        ];
    }
}
