<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    public function __construct($details)
    {
        // Menyimpan data yang dikirim dari Controller ke variabel public
        $this->details = $details;
    }

    public function build()
    {
        return $this->subject('Verifikasi Akun SIMA Enterprise')
            ->view('mailTemplate');
    }
}
