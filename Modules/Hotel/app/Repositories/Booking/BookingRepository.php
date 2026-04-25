<?php

namespace Modules\Hotel\Repositories\Booking;

use Modules\Hotel\Repositories\Booking\Contracts\BookingRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\Booking;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    public function __construct(Booking $model)
    {
        parent::__construct($model);
    }
}
