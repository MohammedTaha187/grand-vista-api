<?php

namespace Modules\Hotel\Services\Payment;

use Modules\Hotel\Services\Payment\Contracts\PaymentServiceInterface;
use Modules\Hotel\Repositories\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Hotel\Models\Payment;
use Modules\Hotel\DTOs\Payment\PaymentData;

use Illuminate\Database\Eloquent\Collection;

class PaymentService implements PaymentServiceInterface
{
    public function __construct(
        private readonly PaymentRepositoryInterface $repo
    ) {}

    public function getAll(): Collection
    {
        return $this->repo->all();
    }

    public function getById(string $id): ?Payment
    {
        return $this->repo->find($id);
    }

    public function create(PaymentData $data): Payment
    {
        $payload = $data->toArray();
        

        return $this->repo->create($payload);
    }

    public function update(string $id, PaymentData $data): bool
    {
        $payload = $data->toArray();
        

        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }
}
