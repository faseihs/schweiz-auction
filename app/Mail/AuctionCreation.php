<?php

namespace App\Mail;

use App\Model\Auction;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuctionCreation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $auction=null;
    private $user=null;
    public function __construct(Auction $auction)
    {
        //
        $this->auction=$auction;
        //$this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.auction-creation')
            ->with(['auction'=>$this->auction]);

            //->to($this->user->email);
    }
}
