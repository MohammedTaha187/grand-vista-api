<?php

namespace Modules\Hotel\Services\Booking;

use Modules\Hotel\Services\Booking\Contracts\BookingServiceInterface;
use Modules\Hotel\Repositories\Booking\Contracts\BookingRepositoryInterface;
use Modules\Hotel\Models\Booking;
use Modules\Hotel\Models\Room;
use Modules\Hotel\Models\BookingRoom;
use Modules\Hotel\DTOs\Booking\BookingData;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingService implements BookingServiceInterface
{
    public function __construct(
        private readonly BookingRepositoryInterface $repo
    ) {}

    public function getAll(): LengthAwarePaginator
    {
        return QueryBuilder::for(Booking::class)
            ->allowedFilters(...[
                'status',
                'payment_status',
                'source',
                AllowedFilter::partial('guest_name'),
                AllowedFilter::partial('guest_email'),
                AllowedFilter::partial('booking_reference'),
                AllowedFilter::callback('date_from', fn($query, $v) => $query->where('check_in_date', '>=', $v)),
                AllowedFilter::callback('date_to', fn($query, $v) => $query->where('check_out_date', '<=', $v)),
            ])
            ->allowedSorts(...['created_at', 'check_in_date', 'check_out_date', 'total_amount'])
            ->defaultSort('-created_at')
            ->paginate(request()->query('per_page', 15))
            ->withQueryString();
    }

    public function getById(string $id): ?Booking
    {
        return $this->repo->find($id);
    }

    public function create(BookingData $data): Booking
    {
        return DB::transaction(function () use ($data) {
            if (!$this->isRoomAvailable($data->room_id, $data->check_in_date, $data->check_out_date)) {
                throw new \Exception('Room not available for selected dates.');
            }

            $breakdown = $this->calculateBreakdown($data->room_id, $data->check_in_date, $data->check_out_date);

            $booking = $this->repo->create([
                'booking_reference' => 'BK-' . strtoupper(Str::random(8)),
                'user_id' => $data->user_id,
                'guest_name' => $data->guest_name,
                'guest_email' => $data->guest_email,
                'guest_phone' => $data->guest_phone,
                'status' => 'pending',
                'check_in_date' => $data->check_in_date,
                'check_out_date' => $data->check_out_date,
                'nights' => $breakdown['nights'],
                'adults' => $data->adults,
                'children' => $data->children,
                'total_amount' => $breakdown['grand_total'],
                'tax_amount' => $breakdown['tax_amount'],
                'balance_due' => $breakdown['grand_total'],
                'currency' => 'USD',
                'payment_status' => 'pending',
            ]);

            $booking->bookingRooms()->create([
                'room_id' => $data->room_id,
                'price_per_night' => $breakdown['base_price_per_night'],
                'nights' => $breakdown['nights'],
                'subtotal' => $breakdown['subtotal'],
            ]);

            Log::info("Booking created: {$booking->booking_reference}", [
                'booking_id' => $booking->id,
                'guest' => $data->guest_name,
                'total' => $booking->total_amount
            ]);

            return $booking;
        });
    }

    public function calculateBreakdown(string $roomId, string $checkIn, string $checkOut, array $addons = [], float $discount = 0): array
    {
        $room = Room::with('roomType')->findOrFail($roomId);
        $start = Carbon::parse($checkIn);
        $end = Carbon::parse($checkOut);
        $nights = $start->diffInDays($end) ?: 1;

        $basePricePerNight = $room->price_override ?? $room->roomType->base_price;
        $roomTotal = $basePricePerNight * $nights;
        
        $subtotal = $roomTotal - $discount;
        if ($subtotal < 0) $subtotal = 0;

        $taxRate = 0.14; // 14% VAT
        $taxAmount = round($subtotal * $taxRate, 2);
        
        $serviceCharge = round($subtotal * 0.10, 2); // 10% Service Charge
        $grandTotal = $subtotal + $taxAmount + $serviceCharge;

        return [
            'nights' => $nights,
            'base_price_per_night' => $basePricePerNight,
            'room_total' => $roomTotal,
            'discount' => $discount,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'service_charge' => $serviceCharge,
            'grand_total' => $grandTotal,
            'room_details' => [
                'name' => $room->room_number,
                'type' => $room->roomType->name
            ]
        ];
    }

    public function confirm(string $id): bool
    {
        return $this->repo->update($id, ['status' => 'confirmed']);
    }

    public function checkIn(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $booking = Booking::with('bookingRooms')->findOrFail($id);
            if ($booking->status !== 'confirmed') {
                throw new \Exception('Booking must be confirmed before check-in.');
            }

            $booking->update(['status' => 'checked_in', 'actual_check_in' => now()]);
            
            // Set rooms to occupied
            foreach ($booking->bookingRooms as $br) {
                $br->room->update(['status' => 'occupied']);
            }

            Log::info("Guest checked-in: {$booking->booking_reference}", ['id' => $id]);

            return true;
        });
    }

    public function checkOut(string $id): bool
    {
        return DB::transaction(function () use ($id) {
            $booking = Booking::with('bookingRooms')->findOrFail($id);
            if ($booking->status !== 'checked_in') {
                throw new \Exception('Guest is not checked-in.');
            }

            $booking->update(['status' => 'checked_out', 'actual_check_out' => now()]);
            
            // Set rooms to maintenance (needs cleaning)
            foreach ($booking->bookingRooms as $br) {
                $br->room->update(['status' => 'maintenance']);
            }

            Log::info("Guest checked-out: {$booking->booking_reference}", ['id' => $id]);

            return true;
        });
    }

    public function cancel(string $id, string $reason = null): bool
    {
        return DB::transaction(function () use ($id, $reason) {
            $booking = Booking::findOrFail($id);
            
            // Simple policy: Full refund if pending/confirmed, no refund if checked_in
            if ($booking->status === 'checked_in') {
                throw new \Exception('Cannot cancel a checked-in booking.');
            }

            return $booking->update([
                'status' => 'cancelled',
                'cancellation_reason' => $reason,
                'cancelled_at' => now()
            ]);
        });
    }

    public function refund(string $id, float $amount = null): bool
    {
        $booking = Booking::findOrFail($id);
        $refundAmount = $amount ?? $booking->paid_amount;

        return $booking->update([
            'status' => 'refunded',
            'refunded_amount' => $refundAmount,
            'payment_status' => 'refunded'
        ]);
    }

    public function update(string $id, BookingData $data): bool
    {
        $payload = array_filter($data->toArray(), fn($v) => !is_null($v));
        return $this->repo->update($id, $payload);
    }

    public function delete(string $id): bool
    {
        return $this->repo->delete($id);
    }

    private function isRoomAvailable(string $roomId, string $checkIn, string $checkOut): bool
    {
        return !BookingRoom::where('room_id', $roomId)
            ->whereHas('booking', function ($query) use ($checkIn, $checkOut) {
                $query->whereIn('status', ['confirmed', 'checked_in'])
                    ->where(function ($q) use ($checkIn, $checkOut) {
                        $q->whereBetween('check_in_date', [$checkIn, $checkOut])
                            ->orWhereBetween('check_out_date', [$checkIn, $checkOut]);
                    });
            })
            ->exists();
    }
}
