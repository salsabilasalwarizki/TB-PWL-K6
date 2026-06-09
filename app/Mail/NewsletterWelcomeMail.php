<?php

namespace App\Mail;

use App\Models\NewsletterSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;
    public $unsubscribeUrl;

    public function __construct(NewsletterSubscription $subscription)
    {
        $this->subscription = $subscription;
        $this->unsubscribeUrl = url('/newsletter/unsubscribe/' . $subscription->token);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Welcome to DataSphere Newsletter!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-welcome',
        );
    }
}