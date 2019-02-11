<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded=[];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function dp(){
        return $this->morphOne('App\Model\File','owner');
    }

    public function getDp(){
        if($this->dp)
            return '/storage/'.$this->dp->path;
        else return 'https://ui-avatars.com/api/?name='.urlencode($this->user->name);
    }
}
