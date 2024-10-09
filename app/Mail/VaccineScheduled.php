<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VaccineScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $scheduledDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($scheduledDate)
    {
        $this->scheduledDate = $scheduledDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.vaccine_scheduled')
                    ->with(['scheduledDate' => $this->scheduledDate]);
    }
}
