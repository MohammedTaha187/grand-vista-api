<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\RoomType\Contracts\RoomTypeServiceInterface;
use Modules\Hotel\Models\RoomType;
use Modules\Hotel\Http\Resources\Api\V1\RoomType\RoomTypeResource;
use Modules\Hotel\Http\Resources\Api\V1\RoomType\RoomTypeCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group RoomType Client API
 *
 * APIs for viewing RoomTypes
 */
class RoomTypeController extends Controller
{
    public function __construct(
        private readonly RoomTypeServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            RoomTypeCollection::make($items),
            'RoomType list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType): JsonResponse
    {
        return $this->successResponse(
            new RoomTypeResource($roomType),
            'RoomType retrieved.'
        );
    }
}
