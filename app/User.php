<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Model\Role');
    }
    
    public function bids(){
        return $this->hasMany('App\Model\Bid');
    }
    public function notifications(){
        return $this->hasMany('App\Model\Notification');
    }
    public function profile(){
        return $this->hasOne('App\Model\Profile');
    }

    public function  getOnlineStatus(){
        if( Carbon::now()->lte(Carbon::parse($this->login)->addMinutes(20)))
            return true;
        else return false;
    }

    public function getNotificationCount(){
        return
       sizeof( $this->notifications()->where('marked',0)->get());
    }

    public function markAllRead(){
        foreach ($this->notifications as $notification){
            $notification->marked=1;
            $notification->save();
        }
    }
}
