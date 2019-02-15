<?php

namespace App\Http\Controllers\Admin;

use App\Model\Auction;
use App\Model\Bid;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //

    //Dashbard Controller to get statistics
    public function index(){

        //All Auctions
        $allAuctions= sizeof(Auction::all());

        //Active Auctions
        $activeAuctions=sizeof(Auction::where('status',1)->get());

        //All Users
        $users=User::all();

        //New Users
        $newUsers=sizeof(User::where('created_at','>=',Carbon::now()->startOfDay()->toDateTimeString())->get());

        //Active Users
        $actve_users=array();
        foreach ($users as $user){
            if($user->getOnlineStatus())
                array_push($actve_users,$user);
        }
        $activeUsers=sizeof($actve_users);
        $allUsers=sizeof($users);

        //Bids Posted Today
        $bidsToday=sizeof(Bid::where('created_at','>=', Carbon::now()->startOfDay()->toDateTimeString())
            ->where('created_at','<=',Carbon::now()->endOfDay()->toDateTimeString())->get());

        // All Bids
        $allBids=sizeof(Bid::all());

        return view('admin.dashboard',compact([
            'allAuctions','activeAuctions','newUsers','activeUsers','allUsers',
            'bidsToday','allBids'
        ]));
    }

    public function users(Request $request){

        //Getting All Users
        $users= User::where('role_id',2)->get();
        if($request->has('type')) {
            $type = $request->type;
            if($type==2)
                $users=User::where('approved',1)->where('role_id',2)->get();
            else if($type==3) $users=User::where('approved',0)->where('role_id',2)->get();
        }
        else $type=1;
        return view('admin.user',compact(['users','type']));
    }


    public function userToggle($id){
        //Approving/ Disapproving User
        $user=User::findOrFail($id);
        try{
            DB::beginTransaction();
            if($user->approved==1)
                $user->approved=0;
            else $user->approved=1;
            $user->save();
            DB::commit();
            return redirect('/admin/users')->with('success','Updated');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }

    //view One User by ID
    public function userView($id){
        $user=User::findOrFail($id);
        return view('admin.user-edit',compact(['user']));
    }

    //Update Users Passworrd
    public function userUpdate(Request $request,$id){
        $user=User::findOrFail($id);
        $this->validate($request,[
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        try{
            DB::beginTransaction();
            $user->password=Hash::make($request->password);
            $user->save();
            DB::commit();
            return redirect('/admin/user/'.$id)->with('success','Updated');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
