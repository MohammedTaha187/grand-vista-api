<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Review\Contracts\ReviewServiceInterface;
use Modules\Hotel\Models\Review;
use Modules\Hotel\Http\Resources\Api\V1\Review\ReviewResource;
use Modules\Hotel\Http\Resources\Api\V1\Review\ReviewCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Review Client API
 *
 * APIs for viewing Reviews
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
     * Display the specified resource.
     */
    public function show(Review $review): JsonResponse
    {
        return $this->successResponse(
            new ReviewResource($review),
            'Review retrieved.'
        );
    }
}
