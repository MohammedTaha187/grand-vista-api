<?php

namespace Modules\Hotel\Repositories\Payment;

use Modules\Hotel\Repositories\Payment\Contracts\PaymentRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\Payment;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }
}
