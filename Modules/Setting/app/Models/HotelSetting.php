<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Modules\Setting\Database\Factories\HotelSetting\HotelSettingFactory;






#[Guarded(['id', 'created_at', 'updated_at', 'deleted_at'])]
class HotelSetting extends Model 
{
    /** @use HasFactory<HotelSettingFactory> */
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';
}
