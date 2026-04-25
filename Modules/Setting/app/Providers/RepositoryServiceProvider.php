<?php

namespace Modules\Setting\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Setting\Repositories\HotelSetting\Contracts\HotelSettingRepositoryInterface;
use Modules\Setting\Repositories\HotelSetting\HotelSettingRepository;
use Modules\Setting\Services\HotelSetting\Contracts\HotelSettingServiceInterface;
use Modules\Setting\Services\HotelSetting\HotelSettingService;

use Modules\Setting\Repositories\ActivityLog\Contracts\ActivityLogRepositoryInterface;
use Modules\Setting\Repositories\ActivityLog\ActivityLogRepository;
use Modules\Setting\Services\ActivityLog\Contracts\ActivityLogServiceInterface;
use Modules\Setting\Services\ActivityLog\ActivityLogService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(HotelSettingRepositoryInterface::class, HotelSettingRepository::class);
        $this->app->bind(ActivityLogRepositoryInterface::class, ActivityLogRepository::class);

        // Services
        $this->app->bind(HotelSettingServiceInterface::class, HotelSettingService::class);
        $this->app->bind(ActivityLogServiceInterface::class, ActivityLogService::class);
    }
}
