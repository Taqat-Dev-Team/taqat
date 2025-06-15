<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ZoomInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $zoomLink;
    public $meetingDate;
    public $meetingTime;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($zoomLink,$meetingDate,$meetingTime)
    {
        $this->zoomLink = $zoomLink;
        $this->meetingTime=$meetingTime;
        $this->meetingDate=$meetingDate;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.zoom_invitation')
                    ->subject('Your Zoom Meeting Invitation')
                    ->with([
                        'zoomLink' => $this->zoomLink,
                        'meetingDate'=>$this->meetingDate,
                        'meetingTime'=>$this->meetingTime,
                    ]);
    }
}
