<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
        public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'order_id' => $this->order->id,
            'title' => 'طلب جديد',
            'body' => 'تم إنشاء طلب جديد #' . $this->order->id,
            'url' => url('/admin/orders/' . $this->order->id),
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'title' => 'طلب جديد',
            'body' => 'تم إنشاء طلب جديد #' . $this->order->id,
            'url' => url('/admin/orders/' . $this->order->id),
        ];
    }
}

