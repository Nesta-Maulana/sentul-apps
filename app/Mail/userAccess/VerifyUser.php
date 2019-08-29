<?php

namespace App\Mail\userAccess;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\userAccess\role;

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
        $email      = $user['email']; 
        $role       = role::find($user['role']);
        $user['role']   = $role->role;
        return $this->view('templateEmail.verifikasiEmail')
                    ->subject("Sisy Menyapa - Verifikasi User")
                    ->with(['email'=>$email,'user'=>$user]);
    }
}
