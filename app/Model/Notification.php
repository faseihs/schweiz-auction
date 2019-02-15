<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    //
    protected $guarded=[];
    public function user(){
        return $this->belongsTo('App\User');
    }


    public function getLink(){
        if(Auth::user()->role_id==1)
            $role=='admin';
        else $role='client';
        if($this->auction_id){
            if($this->type){
                if($this->type=='winner'){
                    return '/'.$role.'/auction-bid/'.$this->auction_id;
                }
                else {
                    return '/'.$role.'/auction/'.$this->auction_id;
                }
            }
            else return '/'.$role.'/auction/'.$this->auction_id;
        }
        else return '#';
    }
}
