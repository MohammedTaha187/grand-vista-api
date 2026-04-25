<?php

namespace Modules\Operations\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Operations\Services\MaintenanceLog\Contracts\MaintenanceLogServiceInterface;
use Modules\Operations\Models\MaintenanceLog;
use Modules\Operations\Http\Requests\Api\V1\MaintenanceLog\StoreMaintenanceLogRequest;
use Modules\Operations\Http\Requests\Api\V1\MaintenanceLog\UpdateMaintenanceLogRequest;
use Modules\Operations\Http\Resources\Api\V1\MaintenanceLog\MaintenanceLogResource;
use Modules\Operations\Http\Resources\Api\V1\MaintenanceLog\MaintenanceLogCollection;
use Modules\Operations\DTOs\MaintenanceLog\MaintenanceLogData;
use Illuminate\Http\JsonResponse;

/**
 * @group MaintenanceLog Management
 *
 * APIs for managing MaintenanceLogs
 */
class MaintenanceLogController extends Controller
{
    public function __construct(
        private readonly MaintenanceLogServiceInterface $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            MaintenanceLogCollection::make($items),
            'MaintenanceLog list retrieved.'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaintenanceLogRequest $request): JsonResponse
    {
        $maintenanceLog = $this->service->create(MaintenanceLogData::from($request->validated()));

        return $this->successResponse(
            new MaintenanceLogResource($maintenanceLog),
            'MaintenanceLog created successfully.',
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(MaintenanceLog $maintenanceLog): JsonResponse
    {
        return $this->successResponse(
            new MaintenanceLogResource($maintenanceLog),
            'MaintenanceLog retrieved.'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaintenanceLogRequest $request, MaintenanceLog $maintenanceLog): JsonResponse
    {
        $this->service->update($maintenanceLog->id, MaintenanceLogData::from($request->validated()));

        return $this->successResponse(
            new MaintenanceLogResource($maintenanceLog->fresh()),
            'MaintenanceLog updated successfully.'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaintenanceLog $maintenanceLog): JsonResponse
    {
        $this->service->delete($maintenanceLog->id);

        return $this->successResponse(null, 'MaintenanceLog deleted successfully.', 204);
    }
}
