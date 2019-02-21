<?php

namespace App\Mail\userAccess;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user       = $this->user;
        $fullname   = $user->fullname; 
        $email      = $user->email; 
        return $this->view('emails.verifikasiUser')
                    ->subject("COBA")
                    ->with(['email'=>$email,'fullname'=>$fullname]);
    }
}
