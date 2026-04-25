<?php

namespace Modules\Hotel\Repositories\BookingRoom;

use Modules\Hotel\Repositories\BookingRoom\Contracts\BookingRoomRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\BookingRoom;

class BookingRoomRepository extends BaseRepository implements BookingRoomRepositoryInterface
{
    public function __construct(BookingRoom $model)
    {
        parent::__construct($model);
    }
}
