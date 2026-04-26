<?php

namespace Modules\Hotel\DTOs\InvoiceItem;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Rule;

class InvoiceItemData extends Data
{
    public function __construct(
        public readonly string $invoice_id,
        public readonly string $description,
        public readonly int $quantity,
        public readonly float $unit_price,
        public readonly float $total_price,
        public readonly string $item_type,
    ) {}
}
