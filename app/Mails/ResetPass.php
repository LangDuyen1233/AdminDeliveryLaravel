<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPass extends Mailable {
    use Queueable, SerializesModels;

    protected $email;
    protected $key;
    protected $name;

    public function __construct( $email, $key, $name ) {
        $this->email = $email;
        $this->key   = $key;
        $this->name  = $name;
    }

    /**
     * Build the message.a
     *
     * @return $this
     */
    public function build() {
        $this->subject( 'QUÊN MẬT KHẨU' );

        return $this->view( 'mail.forgetPass' )->with( [
            'email' => $this->email,
            'key'   => $this->key,
            'name'  => $this->name
        ] );
    }
}
