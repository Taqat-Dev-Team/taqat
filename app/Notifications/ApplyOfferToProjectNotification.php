<?php

namespace App\Notifications;

use App\Channels\CustomDbChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplyOfferToProjectNotification extends Notification
{

    use Queueable;

    public $apply_offer;


    public function __construct($apply_offer)
    {
        $this->apply_offer = $apply_offer;
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
            ->view('mails.apply_project', ['project' => $this->apply_offer, 'user' => $notifiable]);
    }

    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        dd($this->apply_offer);
        return [
            'title' => $this->apply_offer->project->title,
            'description' => $this->apply_offer->description,
            'project_id' => $this->apply_offer->project_id,
        ];
    }
}
