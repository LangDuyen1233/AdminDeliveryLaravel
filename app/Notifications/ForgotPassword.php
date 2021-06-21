<?php


namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ForgotPassword extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via( $notifiable ) {
        return [ 'mail' ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail( $notifiable ) {
        return ( new MailMessage )
            ->subject( "Quên mật khẩu tài khoản hệ thống timviec.gtnlu.site " )
            ->greeting( "Xin chào! " )
            ->line( 'Tài khoản của bạn vừa được yêu cầu quên mật khẩu.' )
            ->line( 'Nếu bạn thực sự thực hiện yêu cầu trên vui lòng nhấn nút Quên mật khẩu ở dưới.' )
            ->action( 'Quên mật khẩu', route( 'doconfirmpass', [
                'email' => $notifiable->email,
                'key'   => $notifiable->random_key
            ] ) )
            ->line( "Ngược lại nếu bạn không thực hiện yêu cầu trên bạn có thể bỏ qua email này." )
            ->line( "Lưu ý: Link có thời gian sử dụng là 12 giờ." )
            ->line( 'Thank you for using our application!' );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray( $notifiable ) {
        return [
            //
        ];
    }

}
