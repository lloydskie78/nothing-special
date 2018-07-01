<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $email;
    protected $emailcontent;
    protected $name;

    public function __construct($formData)
    {
        $this->email = $formData['email'];
        $this->emailcontent = $formData['message'];
        $this->name = $formData['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email,$this->name)
            ->subject('Contact')
            ->view('emails.contact')
            ->with(['sender' => $this->name,'emailcontent' => $this->emailcontent]);
    }
}
