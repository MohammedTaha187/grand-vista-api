<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Amenity\Contracts\AmenityServiceInterface;
use Modules\Hotel\Models\Amenity;
use Modules\Hotel\Http\Requests\Api\V1\Amenity\StoreAmenityRequest;
use Modules\Hotel\Http\Requests\Api\V1\Amenity\UpdateAmenityRequest;
use Modules\Hotel\Http\Resources\Api\V1\Amenity\AmenityResource;
use Modules\Hotel\Http\Resources\Api\V1\Amenity\AmenityCollection;
use Modules\Hotel\DTOs\Amenity\AmenityData;
use Illuminate\Http\JsonResponse;

/**
 * @group Amenity Management
 *
 * APIs for managing Amenitys
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
     * Store a newly created resource in storage.
     */
    public function store(StoreAmenityRequest $request): JsonResponse
    {
        $amenity = $this->service->create(AmenityData::from($request->validated()));

        return $this->successResponse(
            new AmenityResource($amenity),
            'Amenity created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmenityRequest $request, Amenity $amenity): JsonResponse
    {
        $this->service->update($amenity->id, AmenityData::from($request->validated()));

        return $this->successResponse(
            new AmenityResource($amenity->fresh()),
            'Amenity updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Amenity $amenity): JsonResponse
    {
        $this->service->delete($amenity->id);

        return $this->successResponse(null, 'Amenity deleted successfully.', 204);
    }
}
