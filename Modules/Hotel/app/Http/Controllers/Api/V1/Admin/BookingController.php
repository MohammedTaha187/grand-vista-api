<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Booking\Contracts\BookingServiceInterface;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Http\Requests\Api\V1\Booking\StoreBookingRequest;
use Modules\Hotel\Http\Requests\Api\V1\Booking\UpdateBookingRequest;
use Modules\Hotel\Http\Resources\Api\V1\Booking\BookingResource;
use Modules\Hotel\Http\Resources\Api\V1\Booking\BookingCollection;
use Modules\Hotel\DTOs\Booking\BookingData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

/**
 * @group Booking Management
 *
 * APIs for managing Bookings
 */
class BookingController extends Controller
{
    public function __construct(
        private readonly BookingServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    /**
     * @OA\Get(
     *     path="/api/v1/hotel/admin/bookings",
     *     tags={"Admin Bookings"},
     *     summary="List all bookings with filters",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="Successful operation")
     * )
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
     * Store a new Booking
     * 
     * @bodyParam room_id string required The UUID of the room. Example: 98b50e2d-dc99-43ef-b387-052637738f61
     * @bodyParam user_id string required The UUID of the guest/user.
     * @bodyParam guest_name string required Name of the guest. Example: John Doe
     * @bodyParam guest_email string required Email of the guest. Example: john@example.com
     * @bodyParam check_in_date date required Format: YYYY-MM-DD. Example: 2026-05-01
     * @bodyParam check_out_date date required Format: YYYY-MM-DD. Example: 2026-05-05
     * 
     * @response 201 {
     *  "success": true,
     *  "message": "Booking created successfully.",
     *  "data": { "id": "...", "booking_reference": "BK-...", "status": "pending", ... }
     * }
     * @response 422 {
     *  "success": false,
     *  "error_code": "VALIDATION_ERROR",
     *  "errors": { "room_id": ["The room_id field is required."] }
     * }
     */
    /**
     * @OA\Post(
     *     path="/api/v1/hotel/admin/bookings",
     *     tags={"Admin Bookings"},
     *     summary="Create a new booking",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(required=true, @OA\JsonContent(ref="#/components/schemas/StoreBookingRequest")),
     *     @OA\Response(response=201, description="Booking created")
     * )
     */
    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = $this->service->create(BookingData::from($request->validated()));

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
            new BookingResource($booking->load('bookingRooms.room')),
            'Booking retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking): JsonResponse
    {
        $this->service->update($booking->id, BookingData::from($request->validated()));

        return $this->successResponse(
            new BookingResource($booking->fresh()),
            'Booking updated successfully.'
        );
    }

    /**
     * Confirm Booking
     */
    /**
     * @OA\Post(
     *     path="/api/v1/hotel/admin/bookings/{id}/confirm",
     *     tags={"Admin Bookings"},
     *     summary="Confirm a pending booking",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Booking confirmed")
     * )
     */
    public function confirm(Booking $booking): JsonResponse
    {
        $this->service->confirm($booking->id);
        return $this->successResponse(new BookingResource($booking->fresh()), 'Booking confirmed.');
    }

    /**
     * Check-in Guest
     */
    /**
     * @OA\Post(
     *     path="/api/v1/hotel/admin/bookings/{id}/check-in",
     *     tags={"Admin Bookings"},
     *     summary="Check-in a guest",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Checked in successfully")
     * )
     */
    public function checkIn(Booking $booking): JsonResponse
    {
        try {
            $this->service->checkIn($booking->id);
            return $this->successResponse(new BookingResource($booking->fresh()), 'Guest checked-in successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * Check-out Guest
     */
    /**
     * @OA\Post(
     *     path="/api/v1/hotel/admin/bookings/{id}/check-out",
     *     tags={"Admin Bookings"},
     *     summary="Check-out a guest",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="Checked out successfully")
     * )
     */
    public function checkOut(Booking $booking): JsonResponse
    {
        try {
            $this->service->checkOut($booking->id);
            return $this->successResponse(new BookingResource($booking->fresh()), 'Guest checked-out successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * Cancel Booking
     */
    /**
     * @OA\Post(
     *     path="/api/v1/hotel/admin/bookings/{id}/cancel",
     *     tags={"Admin Bookings"},
     *     summary="Cancel a booking",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\RequestBody(required=false, @OA\JsonContent(@OA\Property(property="reason", type="string"))),
     *     @OA\Response(response=200, description="Booking cancelled")
     * )
     */
    public function cancel(Request $request, Booking $booking): JsonResponse
    {
        try {
            $this->service->cancel($booking->id, $request->input('reason'));
            return $this->successResponse(new BookingResource($booking->fresh()), 'Booking cancelled.');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * Refund Booking
     */
    /**
     * @OA\Post(
     *     path="/api/v1/hotel/admin/bookings/{id}/refund",
     *     tags={"Admin Bookings"},
     *     summary="Refund a booking payment",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="string")),
     *     @OA\RequestBody(required=false, @OA\JsonContent(@OA\Property(property="amount", type="number"))),
     *     @OA\Response(response=200, description="Payment refunded")
     * )
     */
    public function refund(Request $request, Booking $booking): JsonResponse
    {
        $this->service->refund($booking->id, $request->input('amount'));
        return $this->successResponse(new BookingResource($booking->fresh()), 'Refund processed.');
    }

    public function destroy(Booking $booking): Response
    {
        $this->service->delete($booking->id);
        return $this->noContentResponse();
    }
}
