<?php

namespace Modules\Hotel\DTOs\Favorite;

use Spatie\LaravelData\Data;

class FavoriteData extends Data
{
    public function __construct(
        public readonly string $user_id,
        public readonly string $room_type_id,
    ) {}
}
