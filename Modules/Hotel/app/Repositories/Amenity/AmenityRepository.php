<?php

namespace Modules\Hotel\Repositories\Amenity;

use Modules\Hotel\Repositories\Amenity\Contracts\AmenityRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\Amenity;

class AmenityRepository extends BaseRepository implements AmenityRepositoryInterface
{
    public function __construct(Amenity $model)
    {
        parent::__construct($model);
    }
}
