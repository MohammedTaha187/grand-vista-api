<?php

namespace Modules\Hotel\Repositories\BookingAddon;

use Modules\Hotel\Repositories\BookingAddon\Contracts\BookingAddonRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\BookingAddon;

class BookingAddonRepository extends BaseRepository implements BookingAddonRepositoryInterface
{
    public function __construct(BookingAddon $model)
    {
        parent::__construct($model);
    }
}
