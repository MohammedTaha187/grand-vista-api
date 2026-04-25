<?php

namespace Modules\Operations\Repositories\MaintenanceLog;

use Modules\Operations\Repositories\MaintenanceLog\Contracts\MaintenanceLogRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Operations\Models\MaintenanceLog;

class MaintenanceLogRepository extends BaseRepository implements MaintenanceLogRepositoryInterface
{
    public function __construct(MaintenanceLog $model)
    {
        parent::__construct($model);
    }
}
