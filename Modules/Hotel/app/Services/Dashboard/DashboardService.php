<?php

namespace Modules\Hotel\Services\Dashboard;

use Modules\Hotel\Services\Dashboard\Contracts\DashboardServiceInterface;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\Review;
use Modules\Hotel\Models\Invoice;
use Modules\Operations\Models\MaintenanceLog;
use Modules\Cms\Models\BlogPost;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardService implements DashboardServiceInterface
{
    public function getOccupancyStats(): array
    {
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $maintenanceRooms = Room::where('status', 'maintenance')->count();
        $availableRooms = Room::where('status', 'available')->count();

        $occupancyRate = $totalRooms > 0 ? round(($occupiedRooms / $totalRooms) * 100, 2) : 0;

        return [
            'total_rooms' => $totalRooms,
            'occupied_rooms' => $occupiedRooms,
            'maintenance_rooms' => $maintenanceRooms,
            'available_rooms' => $availableRooms,
            'occupancy_rate' => $occupancyRate,
        ];
    }

    public function getBookingFunnel(): array
    {
        $stats = Booking::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        // Ensure all statuses are present
        $statuses = ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'];
        $funnel = [];
        foreach ($statuses as $status) {
            $funnel[$status] = $stats[$status] ?? 0;
        }

        return $funnel;
    }

    public function getRevenueStats(string $period = 'month'): array
    {
        $query = Booking::where('payment_status', 'paid');

        if ($period === 'month') {
            $revenue = $query->where('created_at', '>=', Carbon::now()->startOfYear())
                ->select(
                    DB::raw('MONTH(created_at) as label'),
                    DB::raw('SUM(total_amount) as value')
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get();
            
            // Map month numbers to names
            $revenue = $revenue->map(function($item) {
                $item->label = Carbon::create()->month($item->label)->format('F');
                return $item;
            });
        } else {
            // Default to last 30 days
            $revenue = $query->where('created_at', '>=', Carbon::now()->subDays(30))
                ->select(
                    DB::raw('DATE(created_at) as label'),
                    DB::raw('SUM(total_amount) as value')
                )
                ->groupBy('label')
                ->orderBy('label')
                ->get();
        }

        return $revenue->toArray();
    }

    public function getPendingApprovals(): array
    {
        return [
            'reviews' => Review::where('is_approved', false)->count(),
            'blog_posts' => BlogPost::where('is_published', false)->count(),
        ];
    }

    public function getMaintenanceSummary(): array
    {
        return [
            'backlog' => MaintenanceLog::whereIn('status', ['pending', 'in_progress'])->count(),
            'pending' => MaintenanceLog::where('status', 'pending')->count(),
            'in_progress' => MaintenanceLog::where('status', 'in_progress')->count(),
            'completed_today' => MaintenanceLog::where('status', 'completed')
                ->whereDate('updated_at', Carbon::today())
                ->count(),
        ];
    }

    public function getGlobalInsights(): array
    {
        return [
            'occupancy' => $this->getOccupancyStats(),
            'booking_funnel' => $this->getBookingFunnel(),
            'revenue' => [
                'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_amount'),
                'monthly_revenue' => $this->getRevenueStats('month'),
            ],
            'pending_actions' => $this->getPendingApprovals(),
            'maintenance' => $this->getMaintenanceSummary(),
        ];
    }
}
