<?php

namespace Modules\Cms\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Cms\Services\Testimonial\Contracts\TestimonialServiceInterface;
use Modules\Cms\Models\Testimonial;
use Modules\Cms\Http\Requests\Api\V1\Testimonial\StoreTestimonialRequest;
use Modules\Cms\Http\Requests\Api\V1\Testimonial\UpdateTestimonialRequest;
use Modules\Cms\Http\Resources\Api\V1\Testimonial\TestimonialResource;
use Modules\Cms\Http\Resources\Api\V1\Testimonial\TestimonialCollection;
use Modules\Cms\DTOs\Testimonial\TestimonialData;
use Illuminate\Http\JsonResponse;

/**
 * @group Testimonial Management
 *
 * APIs for managing Testimonials
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
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request): JsonResponse
    {
        $testimonial = $this->service->create(TestimonialData::from($request->validated()));

        return $this->successResponse(
            new TestimonialResource($testimonial),
            'Testimonial created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial): JsonResponse
    {
        $this->service->update($testimonial->id, TestimonialData::from($request->validated()));

        return $this->successResponse(
            new TestimonialResource($testimonial->fresh()),
            'Testimonial updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial): JsonResponse
    {
        $this->service->delete($testimonial->id);

        return $this->successResponse(null, 'Testimonial deleted successfully.', 204);
    }
}
