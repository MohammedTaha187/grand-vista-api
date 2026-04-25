<?php

namespace Modules\Hotel\Http\Requests\Api\V1\InvoiceItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_id' => ['sometimes', 'required', 'uuid', 'exists:invoices,id'],
            'description' => ['sometimes', 'required', 'string'],
            'quantity' => ['sometimes', 'required', 'integer', 'min:1'],
            'unit_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'total_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'item_type' => ['sometimes', 'required', 'string'],
        ];
    }
}
