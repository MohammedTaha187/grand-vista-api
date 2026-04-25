<?php

namespace Modules\Cms\Repositories\Faq;

use Modules\Cms\Repositories\Faq\Contracts\FaqRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Cms\Models\Faq;

class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    public function __construct(Faq $model)
    {
        parent::__construct($model);
    }
}
