<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationStatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $oldStatus;
    public $newStatus;

    public function __construct(Registration $registration, $oldStatus, $newStatus)
    {
        $this->registration = $registration;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan Status Pendaftaran PPDB - ' . $this->registration->registration_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-status-notification',
            with: [
                'registration' => $this->registration,
                'oldStatus' => $this->oldStatus,
                'newStatus' => $this->newStatus,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

