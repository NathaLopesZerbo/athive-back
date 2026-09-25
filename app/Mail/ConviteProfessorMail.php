<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConviteProfessorMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $token
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Convite para acessar o sistema'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.convite-professor',
            with: [
                'link' => url("/ativar?token={$this->token}")
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
