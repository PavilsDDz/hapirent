<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class bookMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $fromName;
    public $fromEmail;
    public $date;
    public $hours;
    public $minutes;
    public $phone;
    public $post;
    public $toEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request,$post)
    {
        $this->post = $post;
        $this->mail = $request->message;
        $this->toEmail = $this->post->author->email;
        $this->fromName = $request->name;
        $this->fromEmail = $request->email;
        $this->date = $request->date;
        $this->hours = $request->hours;
        $this->minutes = $request->minutes;
        $this->phone = $request->phone;

        // $this->fromName = $request->name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
        public function build()
    {
        // dd($this->toEmail);
        print_r($this->toEmail);
        return $this->to($this->toEmail)->from(['address' => $this->fromEmail, 'name' => $this->fromName])->view('mail.bookingMail');
    }
}
