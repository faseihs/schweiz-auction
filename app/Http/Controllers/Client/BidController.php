<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    //
    public  function index(Request $request){
        $bids = Auth::user()->bids;
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='won') {
                $bids = Auth::user()->bids()->where('winner',1)->orderBy('amount','DESC')->get();
                $type=2;
            }
            else {

                $bids = Auth::user()->bids()->where('winner',0)->orderBy('amount','DESC')->get();
                $type=3;
            }
        }
        return view('client.auction.bids',compact(['bids','type']));
    }
}
