<?php

namespace Modules\Cms\DTOs\ContactMessage;

use Spatie\LaravelData\Data;

class ContactMessageData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $phone = null,
        public readonly string $subject,
        public readonly string $message,
        public readonly string $status = 'new',
        public readonly ?string $replied_at = null,
        public readonly ?string $replied_by = null,
    ) {}
}
