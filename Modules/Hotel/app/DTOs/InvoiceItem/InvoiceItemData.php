<?php

namespace Modules\Hotel\DTOs\InvoiceItem;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Rule;

class InvoiceItemData extends Data
{
    public function __construct(
        public readonly string $name
    ) {}
}
