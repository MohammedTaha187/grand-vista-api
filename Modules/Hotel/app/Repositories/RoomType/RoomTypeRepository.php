<?php

namespace Modules\Hotel\Repositories\RoomType;

use Modules\Hotel\Repositories\RoomType\Contracts\RoomTypeRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\RoomType;

class RoomTypeRepository extends BaseRepository implements RoomTypeRepositoryInterface
{
    public function __construct(RoomType $model)
    {
        parent::__construct($model);
    }
}
