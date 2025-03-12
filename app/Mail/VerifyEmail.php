<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $verificationCode;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->verificationCode = $user->verification_code; 
    }

    public function build()
    {
        return $this->subject('Xác thực tài khoản của bạn')
                    ->view('client.emails.verify_email')
                    ->with([
                        'user' => $this->user,
                        'verificationCode' => $this->verificationCode, 
                    ]);
                    return $this->subject('Mã xác thực đặt lại mật khẩu')
                    ->view('emails.verify_email')
                    ->with([
                        'name' => $this->user->name,
                        'code' => $this->user->verification_code,
                    ]);
    }
    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Verify Email',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
