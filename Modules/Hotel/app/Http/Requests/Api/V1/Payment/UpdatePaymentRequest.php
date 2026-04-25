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
            'status' => ['sometimes', 'required', Rule::in(['pending', 'completed', 'failed', 'refunded', 'partially_refunded'])],
            'refund_amount' => 'nullable|numeric|min:0',
            'refund_reason' => 'nullable|string',
        ];
    }
}
