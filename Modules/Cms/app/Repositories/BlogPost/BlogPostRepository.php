<?php

namespace Modules\Cms\Repositories\BlogPost;

use Modules\Cms\Repositories\BlogPost\Contracts\BlogPostRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Cms\Models\BlogPost;

class BlogPostRepository extends BaseRepository implements BlogPostRepositoryInterface
{
    public function __construct(BlogPost $model)
    {
        parent::__construct($model);
    }
}
