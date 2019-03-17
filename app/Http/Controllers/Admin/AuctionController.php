<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AuctionCreation;
use App\Mail\AuctionWinner;
use App\Model\Auction;
use App\Model\Bid;
use App\Model\File;
use App\Model\Notification;
use App\Model\Profile;
use App\Model\Vehicle;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $auctions = Auction::all();
        $type=1;
        //If Get Query Paramater of Type is set
        if($Type=$request->has('type'))
        {
            $Type=$request->type;
            //If Query Parameter is 'new'
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

        //returning view
        return view('admin.auction.index',compact(['auctions','type']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //returning view of create auction
        return view('admin.auction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Saving an Auction
        //dd($input=$request->all());
        $input=$request->all();
        $input['start']=$request->start_date.' '.$request->start_time;
        $input['end']=$request->end_date.' '.$request->end_time;

        //Validating the data
        $validator = Validator::make($input, [
            'title'=>'required',
            'vehicle'=>'required',
            'start' => 'required|date|before:end|after:now',
            'end' => 'required|date|after:start',
            'displacement'=>'required|numeric',
            'registration'=>'required|date'

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        //dd($request->all());

        try{
            DB::beginTransaction();

            //Auction Logic
            $auction = new Auction();
            $auction->title=$request->title;
            $auction->vehicle=$request->vehicle;

            $auction->start=$request->start_date.' '.$request->start_time;
            $auction->end=$request->end_date.' '.$request->end_time;

            $auction->save();


            //Vehicle Logic

            $vehicle= new Vehicle();
            $vehicle->auction_id=$auction->id;
            $vehicle->mileage= $request->mileage;
            $vehicle->registration= $request->registration.'-01';
            $vehicle->gear= $request->wheeldrive;
            $vehicle->fuel= $request->fuel;
            $vehicle->body= $request->body;
            $vehicle->displacement= $request->displacement;
            $vehicle->interior= $request->interior;
            $vehicle->exterior_color= $request->exterior_color;
            $vehicle->seats= $request->seats;
            $vehicle->wheeldrive= $request->wheeldrive;
            $vehicle->transported_by= $request->transported_by;
            $vehicle->special_equipment= $request->special_equipment;
            $vehicle->serial_equipment= $request->serial_equipment;
            $vehicle->type= $request->vehicle;
            $vehicle->financial_services= $request->financial_services;
            $vehicle->notes= $request->notes;
            if(isset($request->damagezone))
                $vehicle->damages=implode(',',$request->damagezone);
            if(isset($request->defects))
                $vehicle->defects=implode(',',$request->defects);


            //Conditions Combine
            $vehicle->condition=implode('-',$request->conditions);


            //Vehicle Attributes
            $vd='';
            foreach ($request->vehicle_description_attributes as $key=>$value){
                if(strlen($vd)>1)
                    $vd.='_';
                $pair=$request->vehicle_description_attributes[$key].'-'.$request->vehicle_description_values[$key];
                $vd.=$pair;
            }

            $vehicle->vehicle_description=$vd;
            $vehicle->save();


            //File Upload Handling
            $imageCount=0;
            foreach($request->images as $media){
                $imageCount++;
                $name= 'auction-image-'.$imageCount.'.' . $media->getClientOriginalExtension();
                $path='/public/auctions/' . $auction->id ;
                $media->storeAs($path,$name);

                $file= new File();
                $file->owner_id=$auction->id;
                $file->owner_type='App\Model\Auction';
                $file->mode='auction';
                $file->name=$name;
                $file->path='auctions/' . $auction->id . '/'.$name;
                $file->save();
            }

            //Sending Email Notification and In Built Notification
            $users=User::where('role_id',2)->where('approved','1')->get();
            foreach ($users as $user){
                Mail::to($user->email)->send(new AuctionCreation($auction));
                Notification::create([
                    'user_id'=>$user->id,
                    'text'=>'New '.$auction->vehicle.' has been added',
                    'auction_id'=>$auction->id,
                    'type'=>'auction'
                ]);
            }
            DB::commit();
            return $auction->id;
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json($e,500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //showing an auction
        $auction=Auction::findOrFail($id);
        $defects= $auction->Vehicle->defects?explode(',',$auction->Vehicle->defects):[];
        $damages= $auction->Vehicle->damages?explode(',',$auction->Vehicle->damages):[];

        return view('admin.auction.show',compact(['auction','defects','damages']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //showing edit auction page
        $auction=Auction::findOrFail($id);
        //dd($auction->Vehicle->getDescriptions());
        $defects= $auction->Vehicle->defects?explode(',',$auction->Vehicle->defects):[];
        $damages= $auction->Vehicle->damages?explode(',',$auction->Vehicle->damages):[];
        //dd(array_search('enginsse',$defects)>=0);
        return view('admin.auction.edit',compact(['auction','defects','damages']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //
        $input=$request->all();
        $input['start']=$request->start_date.' '.$request->start_time;
        $input['end']=$request->end_date.' '.$request->end_time;
        $validator = Validator::make($input, [
            'title'=>'required',
            'vehicle'=>'required',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',

            'displacement'=>'required|numeric',
            'registration'=>'required|date'

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        //dd($request->all());

        try{
            DB::beginTransaction();

            //Auction Logic
            $auction = Auction::find($id);
            $auction->title=$request->title;
            $auction->vehicle=$request->vehicle;
            $auction->start=$request->start_date.' '.$request->start_time;
            $auction->end=$request->end_date.' '.$request->end_time;
            $auction->save();


            //Vehicle Logic

            $vehicle= $auction->Vehicle;
            $vehicle->auction_id=$auction->id;
            $vehicle->mileage= $request->mileage;
            $vehicle->registration= $request->registration.'-01';
            $vehicle->gear= $request->wheeldrive;
            $vehicle->fuel= $request->fuel;
            $vehicle->body= $request->body;
            $vehicle->displacement= $request->displacement;
            $vehicle->interior= $request->interior;
            $vehicle->exterior_color= $request->exterior_color;
            $vehicle->seats= $request->seats;
            $vehicle->wheeldrive= $request->wheeldrive;
            $vehicle->transported_by= $request->transported_by;
            $vehicle->special_equipment= $request->special_equipment;
            $vehicle->serial_equipment= $request->serial_equipment;
            $vehicle->type= $request->vehicle;
            $vehicle->notes= $request->notes;
            $vehicle->financial_services= $request->financial_services;
            if(isset($request->damagezone))
                $vehicle->damages=implode(',',$request->damagezone);
            if(isset($request->defects))
            $vehicle->defects=implode(',',$request->defects);


            //Conditions Combine
            $vehicle->condition=implode('-',$request->conditions);


            //Vehicle Attributes
            $vd='';
            foreach ($request->vehicle_description_attributes as $key=>$value){
                if(strlen($vd)>1)
                    $vd.='_';
                $pair=$request->vehicle_description_attributes[$key].'-'.$request->vehicle_description_values[$key];
                $vd.=$pair;
            }

            $vehicle->vehicle_description=$vd;
            $vehicle->save();


            //File Upload Handling
            $imageCount=0;
            if($request->images[0]!=null) {
                foreach ($request->images as $media) {
                    $imageCount++;
                    $name = 'auction-image-' . $imageCount . time().'.' . $media->getClientOriginalExtension();
                    $path = '/public/auctions/' . $auction->id;
                    $media->storeAs($path, $name);

                    $file = new File();
                    $file->owner_id = $auction->id;
                    $file->owner_type = 'App\Model\Auction';
                    $file->mode = 'auction';
                    $file->name = $name;
                    $file->path = 'auctions/' . $auction->id . '/' . $name;
                    $file->save();
                }
            }

            //Deleting Files

            if($request->has('deletes')){
                foreach ($request->deletes as $item) {
                    $f=File::find($item);
                    Storage::delete('/public/'.$f->path);
                    $f->delete();
                }
            }

            //Checking if no image exiss of auction , if true gives error
            if(sizeof($auction->files)<1){
                $validator = Validator::make($input, [
                    'images'=>'required|file',
                ]);
                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 401);
                }
            }
            DB::commit();
            return $auction->id;
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json($e,500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Deleting Auction
        try{
            DB::beginTransaction();
            $auction=Auction::findOrFail($id);

            //Deleting all Bids
            foreach($auction->bids as $bid){
                $bid->delete();
            }
            $auction->delete();
            DB::commit();
            return redirect('/admin/auction')->with('success','Deleted...');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }


    public  function bids($id){
        $auction =Auction::findOrFail($id);
        //$bids=$auction->bids()->orderBy('created_at','DESC')->get();
        //Getting Bids of Auction
        $bids=$auction->getBids();
        return view('admin.auction.bids',compact(['bids','auction']));
    }


    //Function to Choose Bid as Winner
    public  function chooseBid($id){
        try{
            DB::beginTransaction();
            $bid=Bid::findOrFail($id);
            //dd($bid->auction);
            foreach ($bid->auction->bids as $Bid){
                if($bid->id!=$Bid->id) {


                    $Bid->winner = 0;
                    $Bid->save();

                    Mail::to($Bid->user->email)->send(new AuctionWinner($bid->auction, $bid->user,$bid));
                }
            }
            $bid->winner=1;
            $bid->save();
            Mail::to($bid->user->email)->send(new AuctionWinner($bid->auction, $bid->user,$bid));
            Notification::create([
                'user_id'=>$bid->user->id,
                'text'=>'You have won the bid for Auction #'.$bid->auction->id,
                'auction_id'=>$bid->auction->id,
                'type'=>'winner'
            ]);
            DB::commit();
            return redirect('/admin/auction-bids/'.$bid->auction->id)->with('success','Done');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }


    //Function to remove winner
    public  function removeWinner($id){
        try{
            DB::beginTransaction();
            $auction=Auction::findOrFail($id);
            foreach ($auction->bids as $Bid){

                $Bid->winner=0;
                $Bid->save();
            }
            DB::commit();
            return redirect('/admin/auction-bids/'.$auction->id)->with('success','Done');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
