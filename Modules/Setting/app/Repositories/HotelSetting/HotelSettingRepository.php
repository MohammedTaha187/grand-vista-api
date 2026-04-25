<?php

namespace Modules\Setting\Repositories\HotelSetting;

use Modules\Setting\Repositories\HotelSetting\Contracts\HotelSettingRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Setting\Models\HotelSetting;

class HotelSettingRepository extends BaseRepository implements HotelSettingRepositoryInterface
{
    public function __construct(HotelSetting $model)
    {
        parent::__construct($model);
    }
}
