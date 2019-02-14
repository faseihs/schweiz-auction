<?php

namespace App\Mail;

use App\Model\Auction;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuctionWinner extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $auction=null;
    private $user=null;
    public function __construct(Auction $auction, User $user)
    {
        //
        $this->auction=$auction;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.auction-winner')
            ->with(['auction'=>$this->auction,'user'=>$this->user])->subject('Auction Winner Notification');
    }
}
