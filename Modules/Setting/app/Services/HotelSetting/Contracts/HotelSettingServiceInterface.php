<?php

namespace Modules\Setting\Services\HotelSetting\Contracts;

use Modules\Setting\Models\HotelSetting;
use Modules\Setting\DTOs\HotelSetting\HotelSettingData;
use Illuminate\Pagination\LengthAwarePaginator;

interface HotelSettingServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?HotelSetting;

    public function create(HotelSettingData $data): HotelSetting;

    public function update(string $id, HotelSettingData $data): bool;

    public function delete(string $id): bool;
}
