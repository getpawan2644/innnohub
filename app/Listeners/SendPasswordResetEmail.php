<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\PasswordResetEmail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailTemplate;


class SendPasswordResetEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        $user = $event->user;
        $this->sendEmailAlertUser('update-password-confirm','en',$user);
//        $this->sendEmailAlertUser('update-password-confirm','ar',$user);
        //Mail::to($user)->send(new PasswordResetEmail($user));
    }
    public function sendEmailAlertUser($pageName,$locale,$user){
//        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
//        $getSubject = $allEmailTemp->translateOrDefault("en")->title;
//        $getContent = $allEmailTemp->translateOrDefault("en")->content;
//        $ar_getSubject = $allEmailTemp->translateOrDefault("ar")->title;
//        $ar_getContent = $allEmailTemp->translateOrDefault("ar")->content;
           $separator="<br/>-------------------------------------------------------------------<br/>";
//        $subject = str_replace(["{user}"], [$user->first_name.' '.$user->last_name], $getSubject);
//        $message=$getContent.$separator.$ar_getContent;
//        $message = $getContent;
//        Mail::to($user->email)->send(new PasswordResetEmail($subject,$message));
    }
}
