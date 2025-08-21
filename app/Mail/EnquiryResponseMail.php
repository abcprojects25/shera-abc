<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EnquiryResponseMail extends Mailable
{
    use Queueable, SerializesModels;

     public $data;

     public $isAdmin;

    /**
     * Create a new message instance.
     */
    public function __construct($data, $isAdmin = false)
    {
        $this->data = $data;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Build the message.
     */
    public function build()
    {
       if ($this->isAdmin) {
            return $this->subject('New Enquiry from ' . $this->data['first_name'])
                        ->view('admin.emails.enquiry_admin');
        } else {
            return $this->subject('We received your enquiry!')
                        ->view('admin.emails.enquiry_response');
        }
    }
}

    