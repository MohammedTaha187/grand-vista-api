<?php

namespace Modules\Cms\Repositories\Gallery;

use Modules\Cms\Repositories\Gallery\Contracts\GalleryRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Cms\Models\Gallery;

class GalleryRepository extends BaseRepository implements GalleryRepositoryInterface
{
    public function __construct(Gallery $model)
    {
        parent::__construct($model);
    }
}
