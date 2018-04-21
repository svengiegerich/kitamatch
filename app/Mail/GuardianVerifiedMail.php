<?php

namespace App\Mail;

use App\Guardian;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuardianVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $guardian;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Guardian $guardian)
    {
        $this->guardian = $guardian;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.guardian.verified');
    }
}
