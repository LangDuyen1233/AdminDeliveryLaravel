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
    protected $name;

    public function __construct($email, $key, $name)
    {
        $this->email = $email;
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * Build the message.a
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Greenteawindowsservice@gmail.com')
            ->view('mail.forgetPass')
            ->subject("DHNL")
            ->with([
                'email' => $this->email,
                'key' => $this->key,
                'name' => $this->name
            ]);
    }
}
