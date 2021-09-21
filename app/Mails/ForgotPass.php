<?php


namespace App\Mails;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPass extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $key;
    protected $username;


    public function __construct($email, $key, $username)
    {
        $this->email = $email;
        $this->key = $key;
        $this->username = $username;
    }

    /**
     * Build the message.a
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('mail.forgetPass')
            ->subject("FoodDelivery")
            ->with([
                'email' => $this->email,
                'key' => $this->key,
                'name' => $this->username
            ]);
    }
}
