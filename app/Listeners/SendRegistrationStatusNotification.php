<?php

namespace App\Listeners;

use App\Events\RegistrationStatusChanged;
use App\Mail\RegistrationStatusNotification;
use Illuminate\Support\Facades\Mail;

class SendRegistrationStatusNotification
{
    public function handle(RegistrationStatusChanged $event): void
    {
        // Hanya kirim email jika status berubah
        if ($event->oldStatus !== $event->newStatus) {
            Mail::to($event->registration->user->email)
                ->send(new RegistrationStatusNotification(
                    $event->registration,
                    $event->oldStatus,
                    $event->newStatus
                ));
        }
    }
}

