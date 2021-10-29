<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMessageAlert extends Mailable
{
    use Queueable, SerializesModels; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user,$message;
    public function __construct($user, $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.message.admin-alert')
        ->with([
            $user = $this->user,
            $message = $this->message
        ]);
    }
}
