<?php

namespace App\Http\Controllers\Client;

use App\Model\Auction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index(){
        return view('client.dashboard');
    }

    public function auctions(){
        $auctions = Auction::all();
        return view('client.auction.index',compact('auctions'));
    }

    public function auction($id)
    {
        $auction=Auction::findOrFail($id);
        return view('client.auction.show',compact('auction'));
    }
}

