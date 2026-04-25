<?php

namespace Modules\Cms\Repositories\Offer;

use Modules\Cms\Repositories\Offer\Contracts\OfferRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Cms\Models\Offer;

class OfferRepository extends BaseRepository implements OfferRepositoryInterface
{
    public function __construct(Offer $model)
    {
        parent::__construct($model);
    }
}
