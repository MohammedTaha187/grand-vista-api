<?php

namespace Modules\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Cms\Models\Offer;
use Modules\Cms\Models\BlogPost;
use Modules\Cms\Models\Faq;
use Modules\Cms\Models\Gallery;
use App\Models\User;
use Modules\Cms\Database\Factories\Offer\OfferFactory;
use Modules\Cms\Database\Factories\BlogPost\BlogPostFactory;
use Modules\Cms\Database\Factories\Faq\FaqFactory;
use Modules\Cms\Database\Factories\Gallery\GalleryFactory;

class CmsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have some users first
        if (User::count() == 0) {
            User::factory(5)->create();
        }

        OfferFactory::new()->count(10)->create();
        BlogPostFactory::new()->count(15)->create();
        FaqFactory::new()->count(10)->create();
        GalleryFactory::new()->count(20)->create();
    }
}
