<?php

namespace App\Http\Controllers\Admin;

use App\Model\Auction;
use App\Model\File;
use App\Model\Profile;
use App\Model\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


        return view('admin.auction.index',compact(['auctions','type']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
        $input=$request->all();
        $input['start']=$request->start_date.' '.$request->start_time;
        $input['end']=$request->end_date.' '.$request->end_time;
        $validator = Validator::make($input, [
            'title'=>'required',
            'vehicle'=>'required',
            'start' => 'required|date|before:end',
            'end' => 'required|date|after:start',
            'seats'=>'required|numeric',
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
            $vehicle->registration= $request->registration;
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
        //

        $auction=Auction::findOrFail($id);
        return view('admin.auction.show',compact('auction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            DB::beginTransaction();
            $auction=Auction::findOrFail($id);
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
}
