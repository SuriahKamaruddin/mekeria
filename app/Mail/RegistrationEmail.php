<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    use SerializesModels;

    public $user;
    public $activationLink;

    public function __construct($user, $activationLink)
    {
        $this->user = $user;
        $this->activationLink = $activationLink;
    }

    public function build()
    {
        return $this->view('emails.activation') // Specify the email view here
                    ->subject('Account Activation')
                    ->with([
                        'activationLink' => $this->activationLink,
                    ]);
    }
}
