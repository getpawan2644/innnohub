<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookMeeting extends Mailable
{
    use Queueable, SerializesModels;
  public $margeDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$useremail,$companyname,$jobtitle,$companysize,$location,$vendorname)
    {
        $this->username = $username;
        $this->useremail =$useremail;
        $this->companyname =$companyname;
        $this->jobtitle =$jobtitle;
        $this->companysize =$companysize;
        $this->location =$location;
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
        $useremail = $this->useremail;
        $companyname=$this->companyname;
        $jobtitle=$this->jobtitle;
        $companysize=$this->companysize;
        $location=$this->location;
        $vendorname=$this->vendorname;
        //$servicename=$this->servicename;
        return  $this->view('emails.bookmeeting',compact('username','useremail','companyname','jobtitle','companysize','location','vendorname'));
       // return $this->markdown('mails.makeOffer')->with(['getProductdetail'=>$getProductdetail,'buyer'=>$buyer,'offeramount'=>$offeramount]);
    }
}
