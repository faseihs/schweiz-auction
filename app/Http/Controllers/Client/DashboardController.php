<?php

namespace App\Http\Controllers\Client;

use App\Model\Auction;
use App\Model\Bid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Dashboard Page
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

    //All Auctions
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

    //Getting One AUction
    public function auction($id)
    {
        $auction=Auction::findOrFail($id);
        $defects= $auction->Vehicle->defects?explode(',',$auction->Vehicle->defects):[];
        $damages= $auction->Vehicle->damages?explode(',',$auction->Vehicle->damages):[];
        return view('client.auction.show',compact(['auction','defects','damages']));
    }

    //Getting Bids of Auction
    public function getAuctionBid($id){
        $auction=Auction::findOrFail($id);
        return view('client.auction.bid',compact('auction'));
    }


    //Post AUction Bids
    public function postAuctionBid(Request $request,$id){
        $this->validate($request,[
           'amount'=>'required'
        ]);

        try{
            DB::beginTransaction();
            //Check if Lower Bid Exists

            $auction=Auction::findOrFail($id);

            //Checking If Bids with lower amount exists
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
            return redirect('/client/auction/'.$id)->with('success','Successfully Done');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }


    //Getting All Bids
    public  function bids(){
        $bids = Auth::user()->bids;
        return view('client.auction.bids',compact('bids'));
    }


    //Cars Page
    public function cars(Request $request){
        $auctions = Auction::where('vehicle','car')->get();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','car')->get();
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

    //Bikes Page
    public function bikes(Request $request){
        $auctions = Auction::where('vehicle','bike')->get();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','bike')->get();
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

    //Buses
    public function buses(Request $request){
        $auctions = Auction::where('vehicle','bus')->get();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('status',1)->where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','bus')->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->where('vehicle','bus')->get();
                $type=3;
            }
        }

        $vehicle='Bus';
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.auction.index',compact(['auctions','type','vehicle','grid']));
    }

    //Others
    public function others(Request $request){
        $auctions = Auction::where('vehicle','others')->get();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('status',1)->where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','others')->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->where('vehicle','others')->get();
                $type=3;
            }
        }

        $vehicle='Others';
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.auction.index',compact(['auctions','type','vehicle','grid']));
    }

    //Others
    public function allAuctions(Request $request){
        $auctions = Auction::where('status',1)->get();
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('status',1)->where('created_at', '>=', Carbon::parse($log)->subDay(1))->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->where('vehicle','others')->get();
                $type=3;
            }
        }

        $vehicle='All';
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.auction.index',compact(['auctions','type','vehicle','grid']));
    }


    //Cars Page
    public function carsPost(Request $request){
        //dd($request->all());

        $regFrom= $request->reg_from;
        $regTo= $request->reg_to;
        $dispFrom= $request->disp_from;
        $dispTo= $request->disp_to;
        $search= $request->search;

        if(!$regFrom)
            $regFrom='1900-00-00';
        else {
            $regFrom= $regFrom.'-01-01';
        }
        if(!$regTo)
            $regTo='3000-00-00';
        else $regTo= $regTo.'-01-01';
        if(!$dispFrom)
            $dispFrom=0;
        if(!$dispTo)
            $dispTo=100000000000000;




        $auctions= Auction::where('vehicle','car')->get();
        $Auctions=[];
        foreach ($auctions as $auction){
            if($search) {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo
                    && strpos($auction->title, $search) !== false
                )
                    array_push($Auctions, $auction);
            }
            else {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo

                )
                    array_push($Auctions, $auction);
            }

        }

        $type=1;
        $auctions=$Auctions;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','car')->get();
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


    //Bus Post
    public function busesPost(Request $request){
        //dd($request->all());

        $regFrom= $request->reg_from;
        $regTo= $request->reg_to;
        $dispFrom= $request->disp_from;
        $dispTo= $request->disp_to;
        $search= $request->search;

        if(!$regFrom)
            $regFrom='1900-00-00';
        else {
            $regFrom= $regFrom.'-01-01';
        }
        if(!$regTo)
            $regTo='3000-00-00';
        else $regTo= $regTo.'-01-01';
        if(!$dispFrom)
            $dispFrom=0;
        if(!$dispTo)
            $dispTo=100000000000000;




        $auctions= Auction::where('vehicle','bus')->get();
        $Auctions=[];
        foreach ($auctions as $auction){
            if($search) {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo
                    && strpos($auction->title, $search) !== false
                )
                    array_push($Auctions, $auction);
            }
            else {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo

                )
                    array_push($Auctions, $auction);
            }

        }

        $type=1;
        $auctions=$Auctions;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','bus')->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->where('vehicle','bus')->get();
                $type=3;
            }
        }

        $vehicle='Bus';
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.auction.index',compact(['auctions','type','vehicle','grid']));
    }

    //Bus Post
    public function bikesPost(Request $request){
        //dd($request->all());

        $regFrom= $request->reg_from;
        $regTo= $request->reg_to;
        $dispFrom= $request->disp_from;
        $dispTo= $request->disp_to;
        $search= $request->search;

        if(!$regFrom)
            $regFrom='1900-00-00';
        else {
            $regFrom= $regFrom.'-01-01';
        }
        if(!$regTo)
            $regTo='3000-00-00';
        else $regTo= $regTo.'-01-01';
        if(!$dispFrom)
            $dispFrom=0;
        if(!$dispTo)
            $dispTo=100000000000000;




        $auctions= Auction::where('vehicle','bike')->get();
        $Auctions=[];
        foreach ($auctions as $auction){
            if($search) {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo
                    && strpos($auction->title, $search) !== false
                )
                    array_push($Auctions, $auction);
            }
            else {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo

                )
                    array_push($Auctions, $auction);
            }

        }
        $auctions=$Auctions;
        $type=1;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','bike')->get();
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


    //Bus Post
    public function othersPost(Request $request){
        //dd($request->all());

        $regFrom= $request->reg_from;
        $regTo= $request->reg_to;
        $dispFrom= $request->disp_from;
        $dispTo= $request->disp_to;
        $search= $request->search;

        if(!$regFrom)
            $regFrom='1900-00-00';
        else {
            $regFrom= $regFrom.'-01-01';
        }
        if(!$regTo)
            $regTo='3000-00-00';
        else $regTo= $regTo.'-01-01';
        if(!$dispFrom)
            $dispFrom=0;
        if(!$dispTo)
            $dispTo=100000000000000;




        $auctions= Auction::where('vehicle','others')->get();
        $Auctions=[];
        foreach ($auctions as $auction){
            if($search) {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo
                    && strpos($auction->title, $search) !== false
                )
                    array_push($Auctions, $auction);
            }
            else {
                if (Carbon::parse($auction->Vehicle->registration)->gt(Carbon::parse($regFrom))
                    && Carbon::parse($regTo)->gt(Carbon::parse($auction->Vehicle->registration))
                    && $auction->Vehicle->displacement >= $dispFrom
                    && $auction->Vehicle->displacement <= $dispTo

                )
                    array_push($Auctions, $auction);
            }

        }

        $type=1;
        $auctions=$Auctions;
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            if($Type=='new') {
                if ($log = Auth::user()->login) {
                    $auctions = Auction::where('created_at', '>=', Carbon::parse($log)->subDay(1))->where('vehicle','others')->get();
                }
                $type=2;
            }
            else {

                $auctions=Auction::where('status',0)->where('vehicle','others')->get();
                $type=3;
            }
        }

        $vehicle='Others';
        if($request->has('grid'))
            $grid=$request->grid;
        else $grid=1;
        return view('client.auction.index',compact(['auctions','type','vehicle','grid']));
    }
}

