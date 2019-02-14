<?php

namespace App\Mail;

use App\Model\Auction;
use App\Model\Bid;
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
    private $bid=null;
    public function __construct(Auction $auction, User $user,Bid $bid)
    {
        //
        $this->auction=$auction;
        $this->user=$user;
        $this->bid=$bid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.auction-winner')
            ->with(['auction'=>$this->auction,'user'=>$this->user,'bid'=>$this->bid])->subject('Auction Winner Notification');
    }
}
