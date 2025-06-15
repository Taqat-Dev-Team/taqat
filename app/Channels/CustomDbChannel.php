<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class CustomDbChannel
{

    public function send($notifiable, Notification $notification)
    {
        // dd('asas');
        $data = $notification->toDatabase($notifiable);
        return $notifiable->routeNotificationFor('database')->create([
            'id' => $notification->id,
//            'user_id'=> array_key_exists('user_id' , $data) ? $data['user_id'] : null,
            'type' => get_class($notification),
            'data' => $data,
            'project_id'=>array_key_exists('project_id' , $data) ? $data['project_id'] : null,
            'job_id'=>array_key_exists('job_id' , $data) ? $data['job_id'] : null,
            'chat_id'=>array_key_exists('chat_id' , $data) ? $data['chat_id'] : null,
            'read_at' => null,
        ]);
    }

}
