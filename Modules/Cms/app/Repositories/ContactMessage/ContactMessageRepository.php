<?php

namespace Modules\Cms\Repositories\ContactMessage;

use Modules\Cms\Repositories\ContactMessage\Contracts\ContactMessageRepositoryInterface;
use EasyDev\Laravel\Repositories\BaseRepository;
use Modules\Cms\Models\ContactMessage;

class ContactMessageRepository extends BaseRepository implements ContactMessageRepositoryInterface
{
    public function __construct(ContactMessage $model)
    {
        parent::__construct($model);
    }
}
