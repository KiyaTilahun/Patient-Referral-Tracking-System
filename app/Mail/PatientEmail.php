<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class PatientEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $card_number,$token;
    /**
     * Create a new message instance.
     */
    public function __construct($card_number,$token)
    {
        //
        $this->card_number=$card_number;
        $this->token=$token;
      


    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from:'Kiyatilahun7@gmail.com',
            replyTo:'kiyatilahun7@gmail.com',
            subject: 'App Verification',
            
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'utils.patientemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
