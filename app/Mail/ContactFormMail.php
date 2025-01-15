<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    /**
     * Tạo một thông điệp email mới.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    /**
     * Xây dựng nội dung của thông điệp email.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thông tin liên hệ mới')->view('client.auth.mail.contact');
    }
}
