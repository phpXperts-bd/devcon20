<?php

namespace App\Mail;

use App\Models\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
        Log::info("Sending profile update link for the attendee: Type - " . $attendee->type . ' id - ' . $attendee->id . ' email - ' . $attendee->email);
        return $this->subject('Please add your gift shipment address | phpXperts DevCon20')
            ->view('emails.update_profile_link', compact('attendee'));
    }
}
