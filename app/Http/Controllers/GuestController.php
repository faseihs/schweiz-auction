<?php

namespace App\Http\Controllers;

use App\Model\Auction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    //
    public function index()

    {

        $auctions=Auction::where('status',1)->get();
        $auctions=$auctions->filter(function ($obj){
            return Carbon::parse($obj->end)->lt(Carbon::now());
        });

        foreach ($auctions as $auction){
            $auction->close();
        }

        if($user=Auth::user()){
            if($user->role_id==1)
                return redirect('/admin/dashboard');
            else return view('welcome');
        }
        else return view('welcome');

    }
}
