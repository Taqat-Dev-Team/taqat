<?php
namespace App\Notifications;

use App\Channels\CustomDbChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $chat;
    protected $message;

    public function __construct($chat, $message)
    {
        $this->chat = $chat;
        $this->message = $message;

    }

    public function via($notifiable)
    {
        return [ CustomDbChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'دردشة جديدة',
            'description' => $this->message,
            'chat_id' => $this->chat->id,
        ];
    }

    // public function toBroadcast($notifiable)
    // {
    //     dd('asas');
    //     return new BroadcastMessage([
    //         'chat_id' => $this->chat->id,
    //         'message' => $this->message,
    //         'sender_name' => auth('company')->user()->name,
    //     ]);
    // }

    // public function toArray($notifiable)
    // {
    //     return [
    //         'chat_id' => $this->chat->id,
    //         'message' => $this->message,
    //         'sender_name' => auth('company')->user()->name,
    //     ];
    // }
}
