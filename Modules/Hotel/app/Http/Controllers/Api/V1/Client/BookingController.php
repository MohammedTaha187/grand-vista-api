<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Booking\Contracts\BookingServiceInterface;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Http\Resources\Api\V1\Booking\BookingResource;
use Modules\Hotel\Http\Resources\Api\V1\Booking\BookingCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group Booking Client API
 *
 * APIs for viewing Bookings
 */
class BookingController extends Controller
{
    public function __construct(
        private readonly BookingServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            BookingCollection::make($items),
            'Booking list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Modules\Hotel\Http\Requests\Api\V1\Booking\StoreBookingRequest $request): JsonResponse
    {
        $data = \Modules\Hotel\DTOs\Booking\BookingData::from([
            ...$request->validated(),
            'user_id' => $request->user()?->id,
        ]);

        $booking = $this->service->create($data);

        return $this->successResponse(
            new BookingResource($booking),
            'Booking created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): JsonResponse
    {
        return $this->successResponse(
            new BookingResource($booking),
            'Booking retrieved.'
        );
    }
}
