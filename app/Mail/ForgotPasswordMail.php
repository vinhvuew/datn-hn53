<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationCode;

    public function __construct($user)
    {
        $this->user = $user;
        $this->verificationCode = $user->verification_code; 
    }

    public function build()
    {
        return $this->subject('Mã xác thực đặt lại mật khẩu')
                    ->view('client.emails.forgot_password')
                    ->with([ 'user' => $this->user,
                    'verificationCode' => $this->verificationCode, ]);
    }
}
