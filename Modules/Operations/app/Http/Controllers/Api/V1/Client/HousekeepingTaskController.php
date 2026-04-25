<?php

namespace Modules\Operations\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Operations\Services\HousekeepingTask\Contracts\HousekeepingTaskServiceInterface;
use Modules\Operations\Models\HousekeepingTask;
use Modules\Operations\Http\Resources\Api\V1\HousekeepingTask\HousekeepingTaskResource;
use Modules\Operations\Http\Resources\Api\V1\HousekeepingTask\HousekeepingTaskCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group HousekeepingTask Client API
 *
 * APIs for viewing HousekeepingTasks
 */
class HousekeepingTaskController extends Controller
{
    public function __construct(
        private readonly HousekeepingTaskServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            HousekeepingTaskCollection::make($items),
            'HousekeepingTask list retrieved.'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(HousekeepingTask $housekeepingTask): JsonResponse
    {
        return $this->successResponse(
            new HousekeepingTaskResource($housekeepingTask),
            'HousekeepingTask retrieved.'
        );
    }
}
