<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Auction extends Model
{
    //
    protected  $guarded=[];
    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function($model){
            $model->id = self::generateUuid();
        });
    }

    public static function generateUuid()
    {
        return Uuid::generate();
    }

    public function files(){
        return $this->morphMany('App\Model\File','owner');
    }
    
    public function Vehicle(){
        return $this->hasOne('App\Model\Vehicle','auction_id');
    }
    
    public function bids(){
        return $this->hasMany('App\Model\Bid');
    }
}
