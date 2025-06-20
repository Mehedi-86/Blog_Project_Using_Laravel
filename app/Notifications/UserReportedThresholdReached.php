<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserReportedThresholdReached extends Notification
{
    use Queueable;

    public function __construct(public int $reportCount) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You have received ' . $this->reportCount . ' reports. Please review your activity.',
        ];
    }
}
