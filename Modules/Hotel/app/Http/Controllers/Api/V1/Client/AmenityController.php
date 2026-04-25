<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Amenity\Contracts\AmenityServiceInterface;
use Modules\Hotel\Models\Amenity;
use Modules\Hotel\Http\Resources\Api\V1\Amenity\AmenityResource;
use Modules\Hotel\Http\Resources\Api\V1\Amenity\AmenityCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Amenity Client API
 *
 * APIs for viewing Amenitys
 */
class AmenityController extends Controller
{
    public function __construct(
        private readonly AmenityServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            AmenityCollection::make($items),
            'Amenity list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Amenity $amenity): JsonResponse
    {
        return $this->successResponse(
            new AmenityResource($amenity),
            'Amenity retrieved.'
        );
    }
}
