<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Testimonial\Contracts\TestimonialServiceInterface;
use Modules\Cms\Models\Testimonial;
use Modules\Cms\Http\Resources\Api\V1\Testimonial\TestimonialResource;
use Modules\Cms\Http\Resources\Api\V1\Testimonial\TestimonialCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Testimonial Client API
 *
 * APIs for viewing Testimonials
 */
class TestimonialController extends Controller
{
    public function __construct(
        private readonly TestimonialServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            TestimonialCollection::make($items),
            'Testimonial list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial): JsonResponse
    {
        return $this->successResponse(
            new TestimonialResource($testimonial),
            'Testimonial retrieved.'
        );
    }
}
