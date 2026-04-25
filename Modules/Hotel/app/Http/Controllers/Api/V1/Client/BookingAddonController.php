<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\BookingAddon\Contracts\BookingAddonServiceInterface;
use Modules\Hotel\Models\BookingAddon;
use Modules\Hotel\Http\Resources\Api\V1\BookingAddon\BookingAddonResource;
use Modules\Hotel\Http\Resources\Api\V1\BookingAddon\BookingAddonCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group BookingAddon Client API
 *
 * APIs for viewing BookingAddons
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
     * Display the specified resource.
     */
    public function show(BookingAddon $bookingAddon): JsonResponse
    {
        return $this->successResponse(
            new BookingAddonResource($bookingAddon),
            'BookingAddon retrieved.'
        );
    }
}
