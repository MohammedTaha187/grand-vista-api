<?php

namespace Modules\Cms\Database\Factories\BlogPost;

use Modules\Cms\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(5, true),
            'featured_image' => $this->faker->imageUrl(),
            'author_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'category' => $this->faker->randomElement(['travel_tips', 'hotel_news', 'local_guide', 'events', 'wellness', 'dining']),
            'tags' => $this->faker->words(3),
            'is_published' => true,
            'published_at' => now(),
            'meta_title' => $title,
            'meta_description' => $this->faker->sentence(),
            'views_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
