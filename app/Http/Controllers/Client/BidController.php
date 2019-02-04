<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    //
    public  function index(){
        $bids = Auth::user()->bids;
        return view('client.auction.bids',compact('bids'));
    }
}
