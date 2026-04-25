<?php

namespace Modules\Hotel\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Modules\Hotel\Services\Dashboard\Contracts\DashboardServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin Dashboard
 *
 * APIs for Admin Insights and Analytics
 */
class DashboardController extends Controller
{
    public function __construct(
        private readonly DashboardServiceInterface $service
    ) {}

    /**
     * Get Global Insights
     * 
     * Returns a summary of occupancy, revenue, and pending actions.
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            $this->service->getGlobalInsights(),
            'Dashboard insights retrieved.'
        );
    }

    /**
     * Get Occupancy Stats
     */
    public function occupancy(): JsonResponse
    {
        return $this->successResponse(
            $this->service->getOccupancyStats(),
            'Occupancy stats retrieved.'
        );
    }

    /**
     * Get Revenue Report
     */
    public function revenue(Request $request): JsonResponse
    {
        $period = $request->query('period', 'month');
        return $this->successResponse(
            $this->service->getRevenueStats($period),
            'Revenue stats retrieved.'
        );
    }

    /**
     * Get Maintenance Summary
     */
    public function maintenance(): JsonResponse
    {
        return $this->successResponse(
            $this->service->getMaintenanceSummary(),
            'Maintenance summary retrieved.'
        );
    }
}
