<?php

namespace App\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActiveAcount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $key, $username)
    {
        $this->email = $email;
        $this->key = $key;
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return
//            $this->from('badao231199@gmail.com')
            $this->subject("FoodDelivery")
                ->view('mail.activeAccount')
                ->with([
                    'email' => $this->email,
                    'key' => $this->key,
                    'username' => $this->username
                ]);
    }
}
