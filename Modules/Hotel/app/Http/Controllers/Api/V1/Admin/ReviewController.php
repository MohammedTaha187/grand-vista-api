<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Review\Contracts\ReviewServiceInterface;
use Modules\Hotel\Models\Review;
use Modules\Hotel\Http\Requests\Api\V1\Review\StoreReviewRequest;
use Modules\Hotel\Http\Requests\Api\V1\Review\UpdateReviewRequest;
use Modules\Hotel\Http\Resources\Api\V1\Review\ReviewResource;
use Modules\Hotel\Http\Resources\Api\V1\Review\ReviewCollection;
use Modules\Hotel\DTOs\Review\ReviewData;
use Illuminate\Http\JsonResponse;

/**
 * @group Review Management
 *
 * APIs for managing Reviews
 */
class ReviewController extends Controller
{
    public function __construct(
        private readonly ReviewServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            ReviewCollection::make($items),
            'Review list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request): JsonResponse
    {
        $review = $this->service->create(ReviewData::from($request->validated()));

        return $this->successResponse(
            new ReviewResource($review),
            'Review created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review): JsonResponse
    {
        return $this->successResponse(
            new ReviewResource($review),
            'Review retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review): JsonResponse
    {
        $this->service->update($review->id, ReviewData::from($request->validated()));

        return $this->successResponse(
            new ReviewResource($review->fresh()),
            'Review updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review): JsonResponse
    {
        $this->service->delete($review->id);

        return $this->successResponse(null, 'Review deleted successfully.', 204);
    }
}
