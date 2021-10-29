<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AcceptMeeting extends Mailable
{
    use Queueable, SerializesModels;
  public $margeDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$msg,$vendorname,$link,$time)
    {
        $this->username = $username;
        $this->msg =$msg;
        $this->vendorname =$vendorname;
        $this->link =$link;
         $this->time =$time;
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
         $link=$this->link;
         $time=$this->time;
        //$servicename=$this->servicename;
        return  $this->view('emails.acceptmeeting',compact('username','msg','vendorname','link','time'));
       // return $this->markdown('mails.makeOffer')->with(['getProductdetail'=>$getProductdetail,'buyer'=>$buyer,'offeramount'=>$offeramount]);
    }
}
