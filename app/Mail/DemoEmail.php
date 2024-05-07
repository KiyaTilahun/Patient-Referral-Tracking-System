<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $qrCodeSvg="";
    public function __construct()
    {
        //
        $this->qrCodeSvg = QrCode::format('svg')->size(200)->errorCorrection('H')->generate("hello");
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'kiyatilahun7@gmail.com',
            subject: 'QR Code Verification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'utils.demo',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            new Attachment(
                content: $this->qrCodeSvg,
                name: 'qrcode.svg', // Name of the attachment
                contentType: 'image/svg+xml', // MIME type for SVG
            ),
        ];
    }
}
