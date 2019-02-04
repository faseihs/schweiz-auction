<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    //
    protected $guarded=[];
    public function auction(){
        return $this->belongsTo('App\Model\Auction','auction_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
