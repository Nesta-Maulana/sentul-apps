<?php

namespace App\Mail\userAccess;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class verifiedUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userdata)
    {
        $this->user = $userdata;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user       = $this->user; 
        return $this->view('templateEmail.verifikasiUser')
                    ->subject("Approval Account - Verifikasi User")
                    ->with(['user'=>$user]);
    }
}
