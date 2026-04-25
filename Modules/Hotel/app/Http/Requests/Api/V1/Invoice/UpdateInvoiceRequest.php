<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'required', Rule::in(['draft', 'sent', 'paid', 'overdue', 'cancelled', 'partially_paid'])],
            'due_date' => 'sometimes|required|date',
            'paid_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
        ];
    }
}
