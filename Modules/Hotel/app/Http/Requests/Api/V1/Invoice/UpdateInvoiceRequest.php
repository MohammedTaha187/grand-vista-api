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
            'invoice_number' => ['sometimes', 'required', 'string', 'max:255'],
            'booking_id' => ['sometimes', 'required', 'uuid', 'exists:bookings,id'],
            'user_id' => ['sometimes', 'required', 'uuid', 'exists:users,id'],
            'issue_date' => ['sometimes', 'required', 'date'],
            'status' => ['sometimes', 'required', Rule::in(['draft', 'sent', 'paid', 'overdue', 'cancelled', 'partially_paid'])],
            'due_date' => 'sometimes|required|date',
            'subtotal' => ['sometimes', 'required', 'numeric', 'min:0'],
            'tax_rate' => ['nullable', 'numeric', 'min:0'],
            'tax_amount' => ['sometimes', 'required', 'numeric', 'min:0'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'total_amount' => ['sometimes', 'required', 'numeric', 'min:0'],
            'paid_amount' => 'nullable|numeric|min:0',
            'balance_due' => ['sometimes', 'required', 'numeric', 'min:0'],
            'payment_method' => 'nullable|string',
            'paid_at' => ['nullable', 'date'],
            'pdf_url' => ['nullable', 'string'],
            'notes' => 'nullable|string',
        ];
    }
}
