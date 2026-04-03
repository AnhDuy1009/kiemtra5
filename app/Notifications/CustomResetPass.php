<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPass extends Notification {
    use Queueable;
    private $token;

    public function __construct($token) {
        $this->token = $token;
    }

    public function via($notifiable) {
        return ['mail'];
    }

    public function toMail($notifiable) {
        $url = route("password.reset", ["token"=>$this->token]);
        return (new MailMessage)
            ->subject('Lấy lại mật khẩu')
            ->view('email_template.reset_pass', compact("url"));
    }
}