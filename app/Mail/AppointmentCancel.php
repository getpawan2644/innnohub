<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentCancel extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $appointment,$user;
    public function __construct($record,$user)
    {
        $this->appointment = $record;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.appointments.admin-cancel')
        ->with([
            $appointment_date = date('d-m-Y', strtotime($this->appointment['appointment']['date'])),
            $from_time = date("h:i A", strtotime($this->appointment['from_time'])),
            $to_time = date("h:i A", strtotime($this->appointment['to_time'])),
            $user = $this->user
        ]);
    }
}
