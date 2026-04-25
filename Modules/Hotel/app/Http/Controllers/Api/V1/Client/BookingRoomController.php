<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\BookingRoom\Contracts\BookingRoomServiceInterface;
use Modules\Hotel\Models\BookingRoom;
use Modules\Hotel\Http\Resources\Api\V1\BookingRoom\BookingRoomResource;
use Modules\Hotel\Http\Resources\Api\V1\BookingRoom\BookingRoomCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group BookingRoom Client API
 *
 * APIs for viewing BookingRooms
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
     * Display the specified resource.
     */
    public function show(BookingRoom $bookingRoom): JsonResponse
    {
        return $this->successResponse(
            new BookingRoomResource($bookingRoom),
            'BookingRoom retrieved.'
        );
    }
}
