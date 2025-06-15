<?php

namespace App\Notifications;

use App\Channels\CustomDbChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplyOfferToJobNotification extends Notification
{
    use Queueable;

    public $apply_job;

    /**
     * Create a new notification instance.
     *
     * @param $job
     * @return void
     */
    public function __construct($apply_job)
    {
        $this->apply_job = $apply_job;
    }

    /**
     * Get the channels the notification should be sent on.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', CustomDbChannel::class, 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->view('mails.apply_job', ['job' => $this->apply_job, 'user' => $notifiable]);
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->apply_job->jobs->title,
            'description' => $this->apply_job->description,
            'job_id' => $this->apply_job->id,
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
            'description' => $this->apply_job->description,
            'description' => $this->apply_job->description,
            'job_id' => $this->apply_job->id,
        ]);
    }

    /**
     * Convert the notification instance to an array.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->apply_job->title,
            'description' => $this->apply_job->description,
            'job_id' => $this->apply_job->id,
        ];
    }
}
