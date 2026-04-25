<?php

namespace Modules\Cms\Repositories\Testimonial;

use Modules\Cms\Repositories\Testimonial\Contracts\TestimonialRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Cms\Models\Testimonial;

class TestimonialRepository extends BaseRepository implements TestimonialRepositoryInterface
{
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }
}
