<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteForReview extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject, $ar_message,$en_message, $url;
    public function __construct($subject,$en_message,$ar_message,$url)
    {
        $this->subject = $subject;
        $this->en_message = $en_message;
        $this->ar_message = $ar_message;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.users.invite-for-review')
        ->with([
            $subject = $this->subject,
            $ar_message = $this->en_message,
            $ar_message = $this->ar_message,
            $url = $this->url,
        ]);
    }
}
