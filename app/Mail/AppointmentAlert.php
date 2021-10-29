<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $appointment,$user;
    public function __construct($appointment,$user)
    {
        $this->appointment = $appointment;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.appointments.admin-alert')
        ->with([
            // $appointment_date = date('d-m-Y', strtotime($this->appointment['appointment']['date'])),
            // $from_time = date("h:i A", strtotime($this->appointment['from_time'])),
            // $to_time = date("h:i A", strtotime($this->appointment['to_time'])),
            $appointment = $this->appointment,
            $user = $this->user
        ]);
    }
}
