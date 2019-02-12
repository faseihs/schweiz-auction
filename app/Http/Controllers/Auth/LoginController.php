<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    protected function redirectTo(){
        $user=Auth::user();
        $user->login=Carbon::now()->toDateTimeString();
        if(!$user->profile)
            $profile = Profile::create(['user_id'=>$user->id]);
        $user->save();
        if(Auth::user()->role->name=='Admin')
            return '/admin/dashboard';
        else return '/client/dashboard';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(\Illuminate\Http\Request $request)
    {
        //return $request->only($this->username(), 'password');
        return ['email' => $request->{$this->username()}, 'password' => $request->password, 'approved' => 1];
    }

    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|exists:users,email,approved,1',
            'password' => 'required|confirmed'
        ]);
    }*/
}
