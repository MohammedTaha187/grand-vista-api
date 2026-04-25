<?php

namespace Modules\Hotel\Repositories\GuestPreference;

use Modules\Hotel\Repositories\GuestPreference\Contracts\GuestPreferenceRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\GuestPreference;

class GuestPreferenceRepository extends BaseRepository implements GuestPreferenceRepositoryInterface
{
    public function __construct(GuestPreference $model)
    {
        parent::__construct($model);
    }
}
