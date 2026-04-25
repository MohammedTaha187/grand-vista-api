<?php

namespace Modules\Operations\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Operations\Repositories\HousekeepingTask\Contracts\HousekeepingTaskRepositoryInterface;
use Modules\Operations\Repositories\HousekeepingTask\HousekeepingTaskRepository;
use Modules\Operations\Services\HousekeepingTask\Contracts\HousekeepingTaskServiceInterface;
use Modules\Operations\Services\HousekeepingTask\HousekeepingTaskService;

use Modules\Operations\Repositories\MaintenanceLog\Contracts\MaintenanceLogRepositoryInterface;
use Modules\Operations\Repositories\MaintenanceLog\MaintenanceLogRepository;
use Modules\Operations\Services\MaintenanceLog\Contracts\MaintenanceLogServiceInterface;
use Modules\Operations\Services\MaintenanceLog\MaintenanceLogService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(HousekeepingTaskRepositoryInterface::class, HousekeepingTaskRepository::class);
        $this->app->bind(MaintenanceLogRepositoryInterface::class, MaintenanceLogRepository::class);

        // Services
        $this->app->bind(HousekeepingTaskServiceInterface::class, HousekeepingTaskService::class);
        $this->app->bind(MaintenanceLogServiceInterface::class, MaintenanceLogService::class);
    }
}
