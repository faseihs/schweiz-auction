<?php

namespace App\Http\Controllers;

use App\Model\Auction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function userRequest(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect('/register')->with('success','Request Submitted');
    }
}
