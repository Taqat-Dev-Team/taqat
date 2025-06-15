<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paymentDetails;

    /**
     * Create a new message instance.
     *
     * @param array $paymentDetails
     * @return void
     */
    public function __construct($paymentDetails)
    {
        $this->paymentDetails = $paymentDetails;
    }

    public function build()
    {
        return $this->view('mails.payment_user')
        ->with([
            'amount' => $this->paymentDetails['amount'],
            'transactionId' => $this->paymentDetails['transactionId'],
            'paymentDate' => $this->paymentDetails['paymentDate'],
        ])
        ->subject('Payment Confirmation');
    }
}
