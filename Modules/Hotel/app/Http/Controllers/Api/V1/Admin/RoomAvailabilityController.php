<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\RoomAvailability\Contracts\RoomAvailabilityServiceInterface;
use Modules\Hotel\Models\RoomAvailability;
use Modules\Hotel\Http\Requests\Api\V1\RoomAvailability\StoreRoomAvailabilityRequest;
use Modules\Hotel\Http\Requests\Api\V1\RoomAvailability\UpdateRoomAvailabilityRequest;
use Modules\Hotel\Http\Resources\Api\V1\RoomAvailability\RoomAvailabilityResource;
use Modules\Hotel\Http\Resources\Api\V1\RoomAvailability\RoomAvailabilityCollection;
use Modules\Hotel\DTOs\RoomAvailability\RoomAvailabilityData;
use Illuminate\Http\JsonResponse;

/**
 * @group RoomAvailability Management
 *
 * APIs for managing RoomAvailabilitys
 */
class RoomAvailabilityController extends Controller
{
    public function __construct(
        private readonly RoomAvailabilityServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            RoomAvailabilityCollection::make($items),
            'RoomAvailability list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomAvailabilityRequest $request): JsonResponse
    {
        $roomAvailability = $this->service->create(RoomAvailabilityData::from($request->validated()));

        return $this->successResponse(
            new RoomAvailabilityResource($roomAvailability),
            'RoomAvailability created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomAvailability $roomAvailability): JsonResponse
    {
        return $this->successResponse(
            new RoomAvailabilityResource($roomAvailability),
            'RoomAvailability retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomAvailabilityRequest $request, RoomAvailability $roomAvailability): JsonResponse
    {
        $this->service->update($roomAvailability->id, RoomAvailabilityData::from($request->validated()));

        return $this->successResponse(
            new RoomAvailabilityResource($roomAvailability->fresh()),
            'RoomAvailability updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomAvailability $roomAvailability): JsonResponse
    {
        $this->service->delete($roomAvailability->id);

        return $this->successResponse(null, 'RoomAvailability deleted successfully.', 204);
    }
}
