<?php

namespace Modules\Operations\Repositories\HousekeepingTask;

use Modules\Operations\Repositories\HousekeepingTask\Contracts\HousekeepingTaskRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Operations\Models\HousekeepingTask;

class HousekeepingTaskRepository extends BaseRepository implements HousekeepingTaskRepositoryInterface
{
    public function __construct(HousekeepingTask $model)
    {
        parent::__construct($model);
    }
}
