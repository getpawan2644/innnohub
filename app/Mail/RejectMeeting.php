<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectMeeting extends Mailable
{
    use Queueable, SerializesModels;
  public $margeDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$msg,$vendorname)
    {
        $this->username = $username;
        $this->msg =$msg;
        $this->vendorname =$vendorname;
       // $this->servicename =$servicename;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $username= $this->username;
        $msg = $this->msg;
        $vendorname=$this->vendorname;
        //$servicename=$this->servicename;
        return  $this->view('emails.rejectmeeting',compact('username','msg','vendorname'));
       // return $this->markdown('mails.makeOffer')->with(['getProductdetail'=>$getProductdetail,'buyer'=>$buyer,'offeramount'=>$offeramount]);
    }
}
