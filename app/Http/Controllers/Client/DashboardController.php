<?php

namespace App\Http\Controllers\Client;

use App\Model\Auction;
use App\Model\Bid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getAuctionBid($id){
        $auction=Auction::findOrFail($id);
        return view('client.auction.bid',compact('auction'));
    }

    public function postAuctionBid(Request $request,$id){
        $this->validate($request,[
           'amount'=>'required'
        ]);

        try{
            DB::beginTransaction();
            $bid =  new Bid();
            $bid->user_id=Auth::user()->id;
            $bid->auction_id=$id;
            $bid->amount=$request->amount;
            $bid->save();
            DB::commit();
            return redirect('/client/bid')->with('success','Successfully Done');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }

    public  function bids(){
        $bids = Auth::user()->bids;
        return view('client.auction.bids',compact('bids'));
    }
}

