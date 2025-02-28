<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class resetPassWord extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public function __construct($user , $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('client.auth.mail.reset-password')
            ->with(['user' => $this->user ,
                'token' => $this->token
            ]);
    }
}
