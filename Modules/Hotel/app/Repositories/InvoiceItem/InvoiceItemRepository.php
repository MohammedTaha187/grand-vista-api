<?php

namespace Modules\Hotel\Repositories\InvoiceItem;

use Modules\Hotel\Repositories\InvoiceItem\Contracts\InvoiceItemRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\InvoiceItem;

class InvoiceItemRepository extends BaseRepository implements InvoiceItemRepositoryInterface
{
    public function __construct(InvoiceItem $model)
    {
        parent::__construct($model);
    }
}
