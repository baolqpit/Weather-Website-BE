<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeatherForecastMail extends Mailable
{
    use Queueable, SerializesModels;
    public $forecast;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($forecast)
    {
        $this->forecast = $forecast;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Weather Forecast Mail',
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
            view: 'weather_forecast_mail',
            with: [
                'date' => $this->forecast->date, // Sử dụng -> để truy cập thuộc tính
                'temperature' => $this->forecast->temperature,
                'humidity' => $this->forecast->humidity,
                'wind' => $this->forecast->wind,
                'condition' => $this->forecast->condition,
                'icon' => $this->forecast->icon,
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
