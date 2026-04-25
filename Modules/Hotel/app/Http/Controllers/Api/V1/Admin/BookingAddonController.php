<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\BookingAddon\Contracts\BookingAddonServiceInterface;
use Modules\Hotel\Models\BookingAddon;
use Modules\Hotel\Http\Requests\Api\V1\BookingAddon\StoreBookingAddonRequest;
use Modules\Hotel\Http\Requests\Api\V1\BookingAddon\UpdateBookingAddonRequest;
use Modules\Hotel\Http\Resources\Api\V1\BookingAddon\BookingAddonResource;
use Modules\Hotel\Http\Resources\Api\V1\BookingAddon\BookingAddonCollection;
use Modules\Hotel\DTOs\BookingAddon\BookingAddonData;
use Illuminate\Http\JsonResponse;

/**
 * @group BookingAddon Management
 *
 * APIs for managing BookingAddons
 */
class BookingAddonController extends Controller
{
    public function __construct(
        private readonly BookingAddonServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            BookingAddonCollection::make($items),
            'BookingAddon list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingAddonRequest $request): JsonResponse
    {
        $bookingAddon = $this->service->create(BookingAddonData::from($request->validated()));

        return $this->successResponse(
            new BookingAddonResource($bookingAddon),
            'BookingAddon created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(BookingAddon $bookingAddon): JsonResponse
    {
        return $this->successResponse(
            new BookingAddonResource($bookingAddon),
            'BookingAddon retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingAddonRequest $request, BookingAddon $bookingAddon): JsonResponse
    {
        $this->service->update($bookingAddon->id, BookingAddonData::from($request->validated()));

        return $this->successResponse(
            new BookingAddonResource($bookingAddon->fresh()),
            'BookingAddon updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingAddon $bookingAddon): JsonResponse
    {
        $this->service->delete($bookingAddon->id);

        return $this->successResponse(null, 'BookingAddon deleted successfully.', 204);
    }
}
