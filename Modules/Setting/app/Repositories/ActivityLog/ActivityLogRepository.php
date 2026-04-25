<?php

namespace Modules\Setting\Repositories\ActivityLog;

use Modules\Setting\Repositories\ActivityLog\Contracts\ActivityLogRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Setting\Models\ActivityLog;

class ActivityLogRepository extends BaseRepository implements ActivityLogRepositoryInterface
{
    public function __construct(ActivityLog $model)
    {
        parent::__construct($model);
    }
}
