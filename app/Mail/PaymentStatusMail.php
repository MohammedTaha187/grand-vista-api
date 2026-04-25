<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\Hotel\Models\Booking;

class PaymentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Booking $booking,
        public string $status,
        public ?string $transactionId = null
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Payment " . ucfirst($this->status) . " for Booking #{$this->booking->id}",
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.payment_status',
        );
    }
}
