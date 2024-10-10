<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class otpMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $expireTime;

    /**
     * Create a new message instance.
     *
     * @param string $otp
     * @param int $expireTime
     * @return void
     */
    public function __construct($otp, $expireTime)
    {
        $this->otp = $otp;
        $this->expireTime = $expireTime;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Your OTP Code',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'otpMail',
            with: [
                'otp' => $this->otp,
                'expireTime' => $this->expireTime,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
