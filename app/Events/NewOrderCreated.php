<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class NewOrderCreated implements ShouldBroadcast
{
    use SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    // اسم القناة الخاصة التي سيتم البث عليها (القناة الخاصة بالأدمن رقم 1 مثلاً)
    public function broadcastOn()
    {
        return new PrivateChannel('App.Models.Admin.1'); // هنا رقم أول أدمن
    }

    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->id,
            'customer_name' => $this->order->customer_name,
            // أي بيانات تريد إرسالها مع الإشعار
        ];
    }

    public function broadcastAs()
    {
        return 'NewOrderCreated'; // اسم الحدث الذي سترسله في JS
    }
}
