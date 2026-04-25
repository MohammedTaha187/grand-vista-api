<?php

namespace Modules\Setting\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Setting\Services\HotelSetting\Contracts\HotelSettingServiceInterface;
use Modules\Setting\Models\HotelSetting;
use Modules\Setting\Http\Requests\Api\V1\HotelSetting\StoreHotelSettingRequest;
use Modules\Setting\Http\Requests\Api\V1\HotelSetting\UpdateHotelSettingRequest;
use Modules\Setting\Http\Resources\Api\V1\HotelSetting\HotelSettingResource;
use Modules\Setting\Http\Resources\Api\V1\HotelSetting\HotelSettingCollection;
use Modules\Setting\DTOs\HotelSetting\HotelSettingData;
use Illuminate\Http\JsonResponse;

/**
 * @group HotelSetting Management
 *
 * APIs for managing HotelSettings
 */
class HotelSettingController extends Controller
{
    public function __construct(
        private readonly HotelSettingServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            HotelSettingCollection::make($items),
            'HotelSetting list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHotelSettingRequest $request): JsonResponse
    {
        $hotelSetting = $this->service->create(HotelSettingData::from($request->validated()));

        return $this->successResponse(
            new HotelSettingResource($hotelSetting),
            'HotelSetting created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelSetting $hotelSetting): JsonResponse
    {
        return $this->successResponse(
            new HotelSettingResource($hotelSetting),
            'HotelSetting retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHotelSettingRequest $request, HotelSetting $hotelSetting): JsonResponse
    {
        $this->service->update($hotelSetting->id, HotelSettingData::from($request->validated()));

        return $this->successResponse(
            new HotelSettingResource($hotelSetting->fresh()),
            'HotelSetting updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotelSetting $hotelSetting): JsonResponse
    {
        $this->service->delete($hotelSetting->id);

        return $this->successResponse(null, 'HotelSetting deleted successfully.', 204);
    }
}
