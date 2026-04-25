<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\RoomAvailability\Contracts\RoomAvailabilityServiceInterface;
use Modules\Hotel\Models\RoomAvailability;
use Modules\Hotel\Http\Resources\Api\V1\RoomAvailability\RoomAvailabilityResource;
use Modules\Hotel\Http\Resources\Api\V1\RoomAvailability\RoomAvailabilityCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group RoomAvailability Client API
 *
 * APIs for viewing RoomAvailabilitys
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
     * Display the specified resource.
     */
    public function show(RoomAvailability $roomAvailability): JsonResponse
    {
        return $this->successResponse(
            new RoomAvailabilityResource($roomAvailability),
            'RoomAvailability retrieved.'
        );
    }
}
