<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderRequestAdminAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject,$message,$product,$input;
    public function __construct($subject,$message,$product,$input)
    {
        $this->subject = $subject;
        $this->product = $product;
        $this->message = $message;
        $this->input = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.order-request.admin-alert')
        ->with([
            $subject = $this->subject,
            $product = $this->product,
            $message = $this->message,
            $input = $this->input,
        ]);
    }
}
