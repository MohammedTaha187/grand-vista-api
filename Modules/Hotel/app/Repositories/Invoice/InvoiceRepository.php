<?php

namespace Modules\Hotel\Repositories\Invoice;

use Modules\Hotel\Repositories\Invoice\Contracts\InvoiceRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\Invoice;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface
{
    public function __construct(Invoice $model)
    {
        parent::__construct($model);
    }
}
