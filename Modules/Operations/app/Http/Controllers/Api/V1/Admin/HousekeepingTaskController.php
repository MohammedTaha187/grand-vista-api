<?php

namespace Modules\Operations\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Operations\Services\HousekeepingTask\Contracts\HousekeepingTaskServiceInterface;
use Modules\Operations\Models\HousekeepingTask;
use Modules\Operations\Http\Requests\Api\V1\HousekeepingTask\StoreHousekeepingTaskRequest;
use Modules\Operations\Http\Requests\Api\V1\HousekeepingTask\UpdateHousekeepingTaskRequest;
use Modules\Operations\Http\Resources\Api\V1\HousekeepingTask\HousekeepingTaskResource;
use Modules\Operations\Http\Resources\Api\V1\HousekeepingTask\HousekeepingTaskCollection;
use Modules\Operations\DTOs\HousekeepingTask\HousekeepingTaskData;
use Illuminate\Http\JsonResponse;

/**
 * @group HousekeepingTask Management
 *
 * APIs for managing HousekeepingTasks
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
     * Store a newly created resource in storage.
     */
    public function store(StoreHousekeepingTaskRequest $request): JsonResponse
    {
        $housekeepingTask = $this->service->create(HousekeepingTaskData::from($request->validated()));

        return $this->successResponse(
            new HousekeepingTaskResource($housekeepingTask),
            'HousekeepingTask created successfully.',
            201
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

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHousekeepingTaskRequest $request, HousekeepingTask $housekeepingTask): JsonResponse
    {
        $this->service->update($housekeepingTask->id, HousekeepingTaskData::from($request->validated()));

        return $this->successResponse(
            new HousekeepingTaskResource($housekeepingTask->fresh()),
            'HousekeepingTask updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HousekeepingTask $housekeepingTask): JsonResponse
    {
        $this->service->delete($housekeepingTask->id);

        return $this->successResponse(null, 'HousekeepingTask deleted successfully.', 204);
    }
}
