<x-mail::message>
# Payment {{ ucfirst($status) }}

Hello {{ $booking->user->name }},

Your payment for booking **#{{ $booking->id }}** has been **{{ $status }}**.

@if($status === 'success')
Transaction ID: **{{ $transactionId }}**
We have confirmed your booking. We look forward to seeing you!
@else
Unfortunately, the payment could not be processed. Please try again or contact support.
@endif

<x-mail::button :url="config('app.url') . '/bookings/' . $booking->id">
View Booking Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
