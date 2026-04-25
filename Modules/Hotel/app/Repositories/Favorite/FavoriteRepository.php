<?php

namespace Modules\Hotel\Repositories\Favorite;

use Modules\Hotel\Repositories\Favorite\Contracts\FavoriteRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\Favorite;

class FavoriteRepository extends BaseRepository implements FavoriteRepositoryInterface
{
    public function __construct(Favorite $model)
    {
        parent::__construct($model);
    }
}
