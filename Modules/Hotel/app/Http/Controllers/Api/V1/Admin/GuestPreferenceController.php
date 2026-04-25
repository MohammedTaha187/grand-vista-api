<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\GuestPreference\Contracts\GuestPreferenceServiceInterface;
use Modules\Hotel\Models\GuestPreference;
use Modules\Hotel\Http\Requests\Api\V1\GuestPreference\StoreGuestPreferenceRequest;
use Modules\Hotel\Http\Requests\Api\V1\GuestPreference\UpdateGuestPreferenceRequest;
use Modules\Hotel\Http\Resources\Api\V1\GuestPreference\GuestPreferenceResource;
use Modules\Hotel\Http\Resources\Api\V1\GuestPreference\GuestPreferenceCollection;
use Modules\Hotel\DTOs\GuestPreference\GuestPreferenceData;
use Illuminate\Http\JsonResponse;

/**
 * @group GuestPreference Management
 *
 * APIs for managing GuestPreferences
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
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestPreferenceRequest $request): JsonResponse
    {
        $guestPreference = $this->service->create(GuestPreferenceData::from($request->validated()));

        return $this->successResponse(
            new GuestPreferenceResource($guestPreference),
            'GuestPreference created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestPreferenceRequest $request, GuestPreference $guestPreference): JsonResponse
    {
        $this->service->update($guestPreference->id, GuestPreferenceData::from($request->validated()));

        return $this->successResponse(
            new GuestPreferenceResource($guestPreference->fresh()),
            'GuestPreference updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuestPreference $guestPreference): JsonResponse
    {
        $this->service->delete($guestPreference->id);

        return $this->successResponse(null, 'GuestPreference deleted successfully.', 204);
    }
}
