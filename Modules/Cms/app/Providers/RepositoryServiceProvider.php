<?php

namespace Modules\Cms\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Cms\Repositories\Offer\Contracts\OfferRepositoryInterface;
use Modules\Cms\Repositories\Offer\OfferRepository;
use Modules\Cms\Services\Offer\Contracts\OfferServiceInterface;
use Modules\Cms\Services\Offer\OfferService;

use Modules\Cms\Repositories\BlogPost\Contracts\BlogPostRepositoryInterface;
use Modules\Cms\Repositories\BlogPost\BlogPostRepository;
use Modules\Cms\Services\BlogPost\Contracts\BlogPostServiceInterface;
use Modules\Cms\Services\BlogPost\BlogPostService;

use Modules\Cms\Repositories\Gallery\Contracts\GalleryRepositoryInterface;
use Modules\Cms\Repositories\Gallery\GalleryRepository;
use Modules\Cms\Services\Gallery\Contracts\GalleryServiceInterface;
use Modules\Cms\Services\Gallery\GalleryService;

use Modules\Cms\Repositories\Testimonial\Contracts\TestimonialRepositoryInterface;
use Modules\Cms\Repositories\Testimonial\TestimonialRepository;
use Modules\Cms\Services\Testimonial\Contracts\TestimonialServiceInterface;
use Modules\Cms\Services\Testimonial\TestimonialService;

use Modules\Cms\Repositories\Faq\Contracts\FaqRepositoryInterface;
use Modules\Cms\Repositories\Faq\FaqRepository;
use Modules\Cms\Services\Faq\Contracts\FaqServiceInterface;
use Modules\Cms\Services\Faq\FaqService;

use Modules\Cms\Repositories\ContactMessage\Contracts\ContactMessageRepositoryInterface;
use Modules\Cms\Repositories\ContactMessage\ContactMessageRepository;
use Modules\Cms\Services\ContactMessage\Contracts\ContactMessageServiceInterface;
use Modules\Cms\Services\ContactMessage\ContactMessageService;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(OfferRepositoryInterface::class, OfferRepository::class);
        $this->app->bind(BlogPostRepositoryInterface::class, BlogPostRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, TestimonialRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(ContactMessageRepositoryInterface::class, ContactMessageRepository::class);

        // Services
        $this->app->bind(OfferServiceInterface::class, OfferService::class);
        $this->app->bind(BlogPostServiceInterface::class, BlogPostService::class);
        $this->app->bind(GalleryServiceInterface::class, GalleryService::class);
        $this->app->bind(TestimonialServiceInterface::class, TestimonialService::class);
        $this->app->bind(FaqServiceInterface::class, FaqService::class);
        $this->app->bind(ContactMessageServiceInterface::class, ContactMessageService::class);
    }
}
