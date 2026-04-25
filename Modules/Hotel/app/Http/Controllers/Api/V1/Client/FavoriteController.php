<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Favorite\Contracts\FavoriteServiceInterface;
use Modules\Hotel\Models\Favorite;
use Modules\Hotel\Http\Resources\Api\V1\Favorite\FavoriteResource;
use Modules\Hotel\Http\Resources\Api\V1\Favorite\FavoriteCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Favorite Client API
 *
 * APIs for viewing Favorites
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
     * Display the specified resource.
     */
    public function show(Favorite $favorite): JsonResponse
    {
        return $this->successResponse(
            new FavoriteResource($favorite),
            'Favorite retrieved.'
        );
    }
}
