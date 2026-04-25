<?php

namespace Modules\Operations\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use Modules\Operations\Services\MaintenanceLog\Contracts\MaintenanceLogServiceInterface;
use Modules\Operations\Models\MaintenanceLog;
use Modules\Operations\Http\Resources\Api\V1\MaintenanceLog\MaintenanceLogResource;
use Modules\Operations\Http\Resources\Api\V1\MaintenanceLog\MaintenanceLogCollection;
use Illuminate\Http\JsonResponse;

/**
 * @group MaintenanceLog Client API
 *
 * APIs for viewing MaintenanceLogs
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
     * Display the specified resource.
     */
    public function show(MaintenanceLog $maintenanceLog): JsonResponse
    {
        return $this->successResponse(
            new MaintenanceLogResource($maintenanceLog),
            'MaintenanceLog retrieved.'
        );
    }
}
