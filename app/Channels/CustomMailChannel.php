<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class CustomMailChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toMail($notifiable);
    }
}