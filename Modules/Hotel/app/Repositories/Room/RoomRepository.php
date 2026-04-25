<?php

namespace Modules\Hotel\Repositories\Room;

use Modules\Hotel\Repositories\Room\Contracts\RoomRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\Room;

class RoomRepository extends BaseRepository implements RoomRepositoryInterface
{
    public function __construct(Room $model)
    {
        parent::__construct($model);
    }
}
