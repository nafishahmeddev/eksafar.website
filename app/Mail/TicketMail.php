<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $order_details;
    public $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct($event, $order, $order_details)
    {
        $this->order = $order;
        $this->event = $event;
        $this->order_details = $order_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Please collect your ticket.')
            ->markdown('mail.ticket');
    }

    

    
}