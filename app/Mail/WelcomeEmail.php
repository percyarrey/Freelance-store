<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to My Website')
                    ->with([
                        'name' => 'John Doe',
                    ]);
    }
}