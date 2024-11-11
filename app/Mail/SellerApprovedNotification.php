<?php

namespace App\Mail;

use App\Models\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SellerApprovedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $seller;
    public function __construct(Seller $seller)
    {
        $this->seller = $seller; 
    }

    public function build()
    {
        return $this->subject('Your Seller Account Has Been Approved')
                    ->view('client/auth/mail/seller_approved')
                    ->with('seller', $this->seller);
    }
}
