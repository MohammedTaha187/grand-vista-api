<?php

namespace Modules\Hotel\Services\Dashboard\Contracts;

interface DashboardServiceInterface
{
    /**
     * Get overall occupancy statistics.
     */
    public function getOccupancyStats(): array;

    /**
     * Get booking status distribution (funnel).
     */
    public function getBookingFunnel(): array;

    /**
     * Get revenue statistics for a specific period.
     */
    public function getRevenueStats(string $period = 'month'): array;

    /**
     * Get pending items requiring admin action.
     */
    public function getPendingApprovals(): array;

    /**
     * Get maintenance backlog and summary.
     */
    public function getMaintenanceSummary(): array;

    /**
     * Get all dashboard insights combined.
     */
    public function getGlobalInsights(): array;
}
