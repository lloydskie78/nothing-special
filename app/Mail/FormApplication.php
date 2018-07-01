<?php

namespace App\Mail;

use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormApplication extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $email;
    protected $file;
    protected $contact;
    protected $name;

    public function __construct($formData)
    {
        $this->contact = $formData['contact'];
        $this->email = $formData['email'];
        $this->name = $formData['name'];
        $this->file = $formData['attachment'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        dd($this->file->getRealPath());
        return $this->from($this->email,$this->name)
            ->subject('Application')
            ->attach($this->file->getRealPath(),['as' => $this->file->getClientOriginalName(),'mime' => $this->file->getMimeType()])
            ->view('emails.application');
    }
}
