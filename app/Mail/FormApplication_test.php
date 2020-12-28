<?php

namespace App\Mail;

use http\Env\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class FormApplication_test extends Mailable
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
    protected $position;
    protected $date;
    protected $sender;
    public function __construct($formData)
    {

        $this->contact = $formData['contact'];
        $this->email = $formData['email'];
        $this->name = $formData['name'];
        $this->file = $formData['attachment'];
        $this->position = $formData['careers'];
        $this->date = date("m-d-Y");
        $this->sender = 'testmail.citihardware@gmail.com';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        dd($this->file->getRealPath());
        return $this->from($this->sender,$this->name)
            ->replyTo($this->email, $this->name)
            ->subject('Applicant from CITIHARDWARE CAREERS')
            ->attach($this->file->getRealPath(),['as' => $this->file->getClientOriginalName(),'mime' => $this->file->getMimeType()])
            ->view('emails.application')->with('email', $this->email)->with('name', $this->name)->with('contact', $this->contact)->with('position', $this->position)->with('date', $this->date);
    }
}
