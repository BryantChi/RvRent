<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderServicesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $details;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $details)
    {
        //
        $this->title = $title;
        $this->details= $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->subject($this->title)
        ->view('mail.order_services');
    }
}
// 9o-traveller@o-ma.com.tw
// omaoma23800796
