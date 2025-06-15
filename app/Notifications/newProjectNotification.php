<?php

namespace App\Notifications;

use App\Channels\CustomDbChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newProjectNotification extends Notification
{
    use Queueable;

    public $project;

    /**
     * Create a new notification instance.
     *
     * @param $job
     * @return void
     */
    public function __construct($project)
    {

        $this->project = $project;

    }

    /**
     * Get the channels the notification should be sent on.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ CustomDbChannel::class, 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     // dd($this->job);
    //     return (new MailMessage)
    //     ->view('mails.new_project',['project'=>$this->project,
    // 'user'=>$notifiable,
    // ]);
    //     // ->with([
    //     //     'job' => $this->job,
    //     // ]);

    // }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->project->title,
            'description' => $this->project->description,
            'project_id' => $this->project->id,
        ];
    }

    /**
     * Get the broadcast representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => $this->project->title,
            'description' => $this->project->description,
            'project_id' => $this->project->id,
        ]);
    }

}
