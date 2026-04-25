<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\RoomType\Contracts\RoomTypeServiceInterface;
use Modules\Hotel\Models\RoomType;
use Modules\Hotel\Http\Requests\Api\V1\RoomType\StoreRoomTypeRequest;
use Modules\Hotel\Http\Requests\Api\V1\RoomType\UpdateRoomTypeRequest;
use Modules\Hotel\Http\Resources\Api\V1\RoomType\RoomTypeResource;
use Modules\Hotel\Http\Resources\Api\V1\RoomType\RoomTypeCollection;
use Modules\Hotel\DTOs\RoomType\RoomTypeData;
use Illuminate\Http\JsonResponse;

/**
 * @group RoomType Management
 *
 * APIs for managing RoomTypes
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
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomTypeRequest $request): JsonResponse
    {
        $roomType = $this->service->create(RoomTypeData::from($request->validated()));

        return $this->successResponse(
            new RoomTypeResource($roomType),
            'RoomType created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomTypeRequest $request, RoomType $roomType): JsonResponse
    {
        $this->service->update($roomType->id, RoomTypeData::from($request->validated()));

        return $this->successResponse(
            new RoomTypeResource($roomType->fresh()),
            'RoomType updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType): JsonResponse
    {
        $this->service->delete($roomType->id);

        return $this->successResponse(null, 'RoomType deleted successfully.', 204);
    }
}
