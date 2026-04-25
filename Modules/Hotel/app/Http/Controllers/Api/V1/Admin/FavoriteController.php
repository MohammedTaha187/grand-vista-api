<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Favorite\Contracts\FavoriteServiceInterface;
use Modules\Hotel\Models\Favorite;
use Modules\Hotel\Http\Requests\Api\V1\Favorite\StoreFavoriteRequest;
use Modules\Hotel\Http\Requests\Api\V1\Favorite\UpdateFavoriteRequest;
use Modules\Hotel\Http\Resources\Api\V1\Favorite\FavoriteResource;
use Modules\Hotel\Http\Resources\Api\V1\Favorite\FavoriteCollection;
use Modules\Hotel\DTOs\Favorite\FavoriteData;
use Illuminate\Http\JsonResponse;

/**
 * @group Favorite Management
 *
 * APIs for managing Favorites
 */
class FavoriteController extends Controller
{
    public function __construct(
        private readonly FavoriteServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            FavoriteCollection::make($items),
            'Favorite list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request): JsonResponse
    {
        $favorite = $this->service->create(FavoriteData::from($request->validated()));

        return $this->successResponse(
            new FavoriteResource($favorite),
            'Favorite created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Favorite $favorite): JsonResponse
    {
        return $this->successResponse(
            new FavoriteResource($favorite),
            'Favorite retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite): JsonResponse
    {
        $this->service->update($favorite->id, FavoriteData::from($request->validated()));

        return $this->successResponse(
            new FavoriteResource($favorite->fresh()),
            'Favorite updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite): JsonResponse
    {
        $this->service->delete($favorite->id);

        return $this->successResponse(null, 'Favorite deleted successfully.', 204);
    }
}
