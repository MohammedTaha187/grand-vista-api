<?php

namespace Modules\Setting\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Setting\Services\ActivityLog\Contracts\ActivityLogServiceInterface;
use Modules\Setting\Models\ActivityLog;
use Modules\Setting\Http\Resources\Api\V1\ActivityLog\ActivityLogResource;
use Modules\Setting\Http\Resources\Api\V1\ActivityLog\ActivityLogCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group ActivityLog Client API
 *
 * APIs for viewing ActivityLogs
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
     * Display the specified resource.
     */
    public function show(ActivityLog $activityLog): JsonResponse
    {
        return $this->successResponse(
            new ActivityLogResource($activityLog),
            'ActivityLog retrieved.'
        );
    }
}
