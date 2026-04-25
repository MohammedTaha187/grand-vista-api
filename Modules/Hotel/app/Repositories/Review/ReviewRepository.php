<?php

namespace Modules\Hotel\Repositories\Review;

use Modules\Hotel\Repositories\Review\Contracts\ReviewRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Hotel\Models\Review;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
}
