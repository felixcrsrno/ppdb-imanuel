<?php

namespace App\Events;

use App\Models\Registration;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegistrationStatusChanged
{
    use Dispatchable, SerializesModels;

    public $registration;
    public $oldStatus;
    public $newStatus;

    public function __construct(Registration $registration, $oldStatus, $newStatus)
    {
        $this->registration = $registration;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }
}

