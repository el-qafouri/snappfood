<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $restaurant;

    /**
     * Create a new message instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->user = $order->user;
        $this->restaurant = $order->restaurant;
    }

//    /**
//     * Get the message envelope.
//     */
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'Order Mail',
//        );
//    }
//
//    /**
//     * Get the message content definition.
//     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'view.name',
//        );
//    }
//
//    /**
//     * Get the attachments for the message.
//     *
//     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
//     */
//    public function attachments(): array
//    {
//        return [];
//    }

    public function build()
    {
    return $this->view('Mail.order')->subject('new stage for order')->to($this->user->email);
    }

}
