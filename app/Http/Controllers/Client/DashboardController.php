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
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.dashboard',compact(['auctions','type','vehicle','grid']));
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

        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;


        return view('client.auction.index',compact(['auctions','type','grid']));
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
            //Check if Lower Bid Exists

            $auction=Auction::findOrFail($id);
            foreach($auction->bids()->where('user_id',Auth::user()->id)->get() as $bid){
                if($request->amount<=$bid->amount)
                    return redirect('/client/auction-bid/'.$id)->with('deleted','Bid amount lower then previous bids');
            }

            //End Check
            $bid =  new Bid();
            $bid->user_id=Auth::user()->id;
            $bid->auction_id=$id;
            $bid->amount=$request->amount;
            $bid->save();
            DB::commit();
            return redirect('/client/auction-bid/'.$id)->with('success','Successfully Done');
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
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.auction.index',compact(['auctions','type','vehicle','grid']));
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
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.auction.index',compact(['auctions','type','vehicle','grid']));
    }
}

