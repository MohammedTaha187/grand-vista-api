<?php

namespace Modules\Hotel\Repositories\RoomAvailability;

use Modules\Hotel\Repositories\RoomAvailability\Contracts\RoomAvailabilityRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\RoomAvailability;

class RoomAvailabilityRepository extends BaseRepository implements RoomAvailabilityRepositoryInterface
{
    public function __construct(RoomAvailability $model)
    {
        parent::__construct($model);
    }
}
