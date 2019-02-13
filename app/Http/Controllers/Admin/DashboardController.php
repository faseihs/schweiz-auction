<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //

    public function index(){
        return view('admin.dashboard');
    }

    public function users(Request $request){
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

    public function userView($id){
        $user=User::findOrFail($id);
        return view('admin.user-edit',compact(['user']));
    }
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
