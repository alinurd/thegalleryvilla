<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class gmailMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
{
    return $this->subject($this->details['subject'])
                ->replyTo($this->details['email'], $this->details['name'])
                ->view('emails.mail')
                ->with('details', $this->details);
}



    public function build_(){
        return $this->from($this->details['email'])->subject($this->details['subject'])
                    ->view('emails.mail');
    }
}
