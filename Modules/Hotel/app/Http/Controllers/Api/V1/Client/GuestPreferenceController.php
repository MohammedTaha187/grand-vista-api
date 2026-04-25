<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\GuestPreference\Contracts\GuestPreferenceServiceInterface;
use Modules\Hotel\Models\GuestPreference;
use Modules\Hotel\Http\Resources\Api\V1\GuestPreference\GuestPreferenceResource;
use Modules\Hotel\Http\Resources\Api\V1\GuestPreference\GuestPreferenceCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group GuestPreference Client API
 *
 * APIs for viewing GuestPreferences
 */
class GuestPreferenceController extends Controller
{
    public function __construct(
        private readonly GuestPreferenceServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            GuestPreferenceCollection::make($items),
            'GuestPreference list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(GuestPreference $guestPreference): JsonResponse
    {
        return $this->successResponse(
            new GuestPreferenceResource($guestPreference),
            'GuestPreference retrieved.'
        );
    }
}
