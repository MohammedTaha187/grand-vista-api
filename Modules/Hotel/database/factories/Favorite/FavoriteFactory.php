<?php

namespace Modules\Hotel\Database\Factories\Favorite;

use Modules\Hotel\Models\Favorite;
use App\Models\User;
use Modules\Hotel\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    protected $model = Favorite::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'room_type_id' => RoomType::factory(),
        ];
    }
}
