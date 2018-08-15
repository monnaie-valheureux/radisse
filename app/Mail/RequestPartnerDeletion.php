<?php

namespace App\Mail;

use App\Partner;
use App\TeamMember;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestPartnerDeletion extends Mailable
{
    use Queueable, SerializesModels;

    public $partner;

    public $teamMember;

    public $reason;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Partner $partner, TeamMember $teamMember, $reason)
    {
        $this->partner = $partner;
        $this->teamMember = $teamMember;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bot@valheureux.be')
            ->subject("[valheureux.be] Demande de suppression de partenaire ({$this->partner->name})")
            ->text('emails.request-partner-deletion');
    }
}
