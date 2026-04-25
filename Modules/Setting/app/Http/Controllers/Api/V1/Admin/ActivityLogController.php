<?php

namespace Modules\Setting\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Setting\Services\ActivityLog\Contracts\ActivityLogServiceInterface;
use Modules\Setting\Models\ActivityLog;
use Modules\Setting\Http\Requests\Api\V1\ActivityLog\StoreActivityLogRequest;
use Modules\Setting\Http\Requests\Api\V1\ActivityLog\UpdateActivityLogRequest;
use Modules\Setting\Http\Resources\Api\V1\ActivityLog\ActivityLogResource;
use Modules\Setting\Http\Resources\Api\V1\ActivityLog\ActivityLogCollection;
use Modules\Setting\DTOs\ActivityLog\ActivityLogData;
use Illuminate\Http\JsonResponse;

/**
 * @group ActivityLog Management
 *
 * APIs for managing ActivityLogs
 */
class ActivityLogController extends Controller
{
    public function __construct(
        private readonly ActivityLogServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            ActivityLogCollection::make($items),
            'ActivityLog list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityLogRequest $request): JsonResponse
    {
        $activityLog = $this->service->create(ActivityLogData::from($request->validated()));

        return $this->successResponse(
            new ActivityLogResource($activityLog),
            'ActivityLog created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(ActivityLog $activityLog): JsonResponse
    {
        return $this->successResponse(
            new ActivityLogResource($activityLog),
            'ActivityLog retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityLogRequest $request, ActivityLog $activityLog): JsonResponse
    {
        $this->service->update($activityLog->getKey(), ActivityLogData::from($request->validated()));

        return $this->successResponse(
            new ActivityLogResource($activityLog->fresh()),
            'ActivityLog updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActivityLog $activityLog): JsonResponse
    {
        $this->service->delete($activityLog->getKey());

        return $this->successResponse(null, 'ActivityLog deleted successfully.', 204);
    }
}
