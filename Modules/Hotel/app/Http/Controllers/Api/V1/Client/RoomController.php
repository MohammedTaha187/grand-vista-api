<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Room\Contracts\RoomServiceInterface;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Http\Resources\Api\V1\Room\RoomResource;
use Modules\Hotel\Http\Resources\Api\V1\Room\RoomCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Room Client API
 *
 * APIs for viewing Rooms
 */
class RoomController extends Controller
{
    public function __construct(
        private readonly RoomServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            RoomCollection::make($items),
            'Room list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): JsonResponse
    {
        return $this->successResponse(
            new RoomResource($room),
            'Room retrieved.'
        );
    }
}
