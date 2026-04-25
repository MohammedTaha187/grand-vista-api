<?php

namespace Modules\Setting\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Setting\Services\HotelSetting\Contracts\HotelSettingServiceInterface;
use Modules\Setting\Models\HotelSetting;
use Modules\Setting\Http\Resources\Api\V1\HotelSetting\HotelSettingResource;
use Modules\Setting\Http\Resources\Api\V1\HotelSetting\HotelSettingCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group HotelSetting Client API
 *
 * APIs for viewing HotelSettings
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
     * Display the specified resource.
     */
    public function show(HotelSetting $hotelSetting): JsonResponse
    {
        return $this->successResponse(
            new HotelSettingResource($hotelSetting),
            'HotelSetting retrieved.'
        );
    }
}
