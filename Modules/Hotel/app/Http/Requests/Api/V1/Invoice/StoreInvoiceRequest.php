<?php

namespace Modules\Hotel\Http\Requests\Api\V1\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', \Modules\Hotel\Models\Invoice::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_number' => ['required', 'string', 'max:255'],
            'booking_id' => ['required', 'uuid', 'exists:bookings,id'],
            'user_id' => ['required', 'uuid', 'exists:users,id'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['required', 'date'],
            'subtotal' => ['required', 'numeric', 'min:0'],
            'tax_rate' => ['nullable', 'numeric', 'min:0'],
            'tax_amount' => ['required', 'numeric', 'min:0'],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'paid_amount' => ['nullable', 'numeric', 'min:0'],
            'balance_due' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable', 'string'],
            'payment_method' => ['nullable', 'string'],
            'paid_at' => ['nullable', 'date'],
            'pdf_url' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
