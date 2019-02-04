<?php

namespace App\Http\Controllers\Common;

use App\Model\File;
use App\Model\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //
    public function getAccountSettings(){
        $user= Auth::user();
        return view('common.account',compact('user'));
    }

    public function postAccountSettings(Request $request){
        $user=Auth::user();

        $this->validate($request,[
            'name' => 'required',
            'email' => 'unique:users,email,'.$user->id
        ]);

        try{
            DB::beginTransaction();
            $input=[];
            $input['name']=$request->name;
            $input['email']=$request->email;
            if($request->password!=null){
                $this->validate($request,[
                    'old_password' => 'required|string',
                    'password' => 'required|string|min:6|confirmed',
                ]);

                if(!Hash::check($request['old_password'],Auth::user()->getAuthPassword()))
                    return Redirect::back()->withInput(Input::all())->withErrors(['','Old Password do not match']);

                if(Hash::check($request['password'],Auth::user()->getAuthPassword()))
                    return Redirect::back()->withInput(Input::all())->withErrors(['','New Password same to old password']);
                $input['password']=bcrypt($request['password']);
            }
            $user->update($input);

            DB::commit();
            return redirect('/common/account-settings')->with('success','Updated');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
    public function getProfileSettings(){
        $user=Auth::user();
        if(!$profile=$user->profile) {
            $profile = new Profile(['user_id' => $user->id]);
            $profile->save();
        }
        $countries=DB::table('countries')->pluck('name','code');
        return view('common.profile',compact(['profile','countries']));
    }

    public function postProfileSettings(Request $request){
        try{
            //dd($request->all());
            DB::beginTransaction();
            $profile=Auth::user()->profile;
            $profile->update($request->except('dp'));

            if($media=$request->file('dp')){
                if($profile->dp){
                    $profile->dp->delete();
                }
                $name= 'dp.' . $media->getClientOriginalExtension();
                $path='/public/users/' . $profile->user->id ;
                $media->storeAs($path,$name);

                $file= new File();
                $file->owner_id=$profile->id;
                $file->owner_type='App\Model\Profile';
                $file->mode='dp';
                $file->name=$name;
                $file->path='users/' . $profile->user->id . '/'.$name;
                $file->save();
            }
            DB::commit();
            return redirect('/common/profile-settings')->with('success','Updated...');
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
