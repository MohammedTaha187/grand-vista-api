<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\BookingRoom\Contracts\BookingRoomServiceInterface;
use Modules\Hotel\Models\BookingRoom;
use Modules\Hotel\Http\Requests\Api\V1\BookingRoom\StoreBookingRoomRequest;
use Modules\Hotel\Http\Requests\Api\V1\BookingRoom\UpdateBookingRoomRequest;
use Modules\Hotel\Http\Resources\Api\V1\BookingRoom\BookingRoomResource;
use Modules\Hotel\Http\Resources\Api\V1\BookingRoom\BookingRoomCollection;
use Modules\Hotel\DTOs\BookingRoom\BookingRoomData;
use Illuminate\Http\JsonResponse;

/**
 * @group BookingRoom Management
 *
 * APIs for managing BookingRooms
 */
class BookingRoomController extends Controller
{
    public function __construct(
        private readonly BookingRoomServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            BookingRoomCollection::make($items),
            'BookingRoom list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRoomRequest $request): JsonResponse
    {
        $bookingRoom = $this->service->create(BookingRoomData::from($request->validated()));

        return $this->successResponse(
            new BookingRoomResource($bookingRoom),
            'BookingRoom created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingRoom $bookingRoom): JsonResponse
    {
        return $this->successResponse(
            new BookingRoomResource($bookingRoom),
            'BookingRoom retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRoomRequest $request, BookingRoom $bookingRoom): JsonResponse
    {
        $this->service->update($bookingRoom->id, BookingRoomData::from($request->validated()));

        return $this->successResponse(
            new BookingRoomResource($bookingRoom->fresh()),
            'BookingRoom updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingRoom $bookingRoom): JsonResponse
    {
        $this->service->delete($bookingRoom->id);

        return $this->successResponse(null, 'BookingRoom deleted successfully.', 204);
    }
}
