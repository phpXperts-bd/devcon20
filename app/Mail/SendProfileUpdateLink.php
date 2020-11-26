<?php

namespace App\Mail;

use App\Models\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendProfileUpdateLink extends Mailable
{
    use Queueable, SerializesModels;

    protected $attendee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Attendee $attendee)
    {
        $this->attendee = $attendee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $attendee = $this->attendee;
        return $this->subject('Add phpXperts DevCon20 gift shipment address')
            ->view('emails.update_profile_link', compact('attendee'));
    }
}
