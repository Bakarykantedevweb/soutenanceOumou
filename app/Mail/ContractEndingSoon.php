<?php

namespace App\Mail;

use App\Models\Contract;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractEndingSoon extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $joursRestants;

    public function __construct(Contract $contract, $joursRestants)
    {
        $this->contract = $contract;
        $this->joursRestants = $joursRestants;
    }

    public function build()
    {
        return $this->subject('Alerte : Contrat CDD arrivant à expiration')
            ->view('emails.contracts.ending_soon');
    }
}
