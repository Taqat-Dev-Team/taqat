<?php
namespace App\Notifications;

use App\Channels\CustomDbChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class JobCreatedNotification extends Notification
{
    use Queueable;

    public $job;

    /**
     * Create a new notification instance.
     *
     * @param $job
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
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
            ->view('mails.new_job', ['job' => $this->job, 'user' => $notifiable]);
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
            'title' => $this->job->title,
            'description' => $this->job->description,
            'job_id' => $this->job->id,
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
            'title' => $this->job->title,
            'description' => $this->job->description,
            'job_id' => $this->job->id,
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
            'title' => $this->job->title,
            'description' => $this->job->description,
            'job_id' => $this->job->id,
        ];
    }
}
