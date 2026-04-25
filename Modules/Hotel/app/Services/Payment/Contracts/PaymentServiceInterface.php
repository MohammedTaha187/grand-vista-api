<?php

namespace Modules\Hotel\Services\Payment\Contracts;

use Modules\Hotel\Models\Payment;
use Modules\Hotel\DTOs\Payment\PaymentData;
use Illuminate\Database\Eloquent\Collection;

interface PaymentServiceInterface
{
    public function getAll(): Collection;

    public function getById(string $id): ?Payment;

    public function create(PaymentData $data): Payment;

    public function update(string $id, PaymentData $data): bool;

    public function delete(string $id): bool;
}
