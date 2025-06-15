<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class FirebaseChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toFirebase($notifiable);
    }
}