<?php

namespace Modules\Hotel\Services\Booking\Contracts;

use Modules\Hotel\Models\Booking;
use Modules\Hotel\DTOs\Booking\BookingData;
use Illuminate\Pagination\LengthAwarePaginator;

interface BookingServiceInterface
{
    public function getAll(): LengthAwarePaginator;

    public function getById(string $id): ?Booking;

    public function create(BookingData $data): Booking;

    public function update(string $id, BookingData $data): bool;

    public function delete(string $id): bool;

    // Workflow Transitions
    public function confirm(string $id): bool;

    public function checkIn(string $id): bool;

    public function checkOut(string $id): bool;

    public function cancel(string $id, string $reason = null): bool;

    public function refund(string $id, float $amount = null): bool;

    /**
     * Calculate detailed pricing breakdown for a potential booking.
     */
    public function calculateBreakdown(string $roomId, string $checkIn, string $checkOut, array $addons = []): array;
}
