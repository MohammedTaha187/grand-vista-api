<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Room\Contracts\RoomServiceInterface;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Http\Requests\Api\V1\Room\StoreRoomRequest;
use Modules\Hotel\Http\Requests\Api\V1\Room\UpdateRoomRequest;
use Modules\Hotel\Http\Resources\Api\V1\Room\RoomResource;
use Modules\Hotel\Http\Resources\Api\V1\Room\RoomCollection;
use Modules\Hotel\DTOs\Room\RoomData;
use Illuminate\Http\JsonResponse;

/**
 * @group Room Management
 *
 * APIs for managing Rooms
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
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request): JsonResponse
    {
        $room = $this->service->create(RoomData::from($request->validated()));

        return $this->successResponse(
            new RoomResource($room),
            'Room created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room): JsonResponse
    {
        $this->service->update($room->id, RoomData::from($request->validated()));

        return $this->successResponse(
            new RoomResource($room->fresh()),
            'Room updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): JsonResponse
    {
        $this->service->delete($room->id);

        return $this->successResponse(null, 'Room deleted successfully.', 204);
    }
}
