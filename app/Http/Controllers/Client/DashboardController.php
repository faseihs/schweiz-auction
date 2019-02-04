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
    public function index(Request $request){
        $auctions = Auction::all();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', $log)->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->get();
                $type=3;
            }
        }

        $vehicle='Auctions';
        return view('client.dashboard',compact(['auctions','type','vehicle']));
    }


    public function auctions(Request $request){
        $auctions = Auction::all();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', $log)->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->get();
                $type=3;
            }
        }


        return view('client.auction.index',compact(['auctions','type']));
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


    public function cars(Request $request){
        $auctions = Auction::where('vehicle','car')->get();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', $log)->where('vehicle','car')->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->where('vehicle','car')->get();
                $type=3;
            }
        }

        $vehicle='Cars';
        return view('client.auction.index',compact(['auctions','type','vehicle']));
    }
    public function bikes(Request $request){
        $auctions = Auction::where('vehicle','bike')->get();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', $log)->where('vehicle','bike')->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->where('vehicle','bike')->get();
                $type=3;
            }
        }

        $vehicle='Bikes';
        return view('client.auction.index',compact(['auctions','type','vehicle']));
    }
}

