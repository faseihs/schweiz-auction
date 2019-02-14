<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    public function getThumbnail(){
        if($top=$this->files()->first())
            return $top->getImage();
        else return '#';
    }


    public function close(){
        /*$bids= $this->bids;
        if(sizeof($bids)<1)
            return;
        $maxAmount= $bids->max(function ($obj){
            return $obj->amount;
        });
        $max=$bids->where('amount',$maxAmount);
        if(sizeof($max)>1)
        {
            $early= $max->min(function ($obj){
                return Carbon::parse($obj->created_at);
            });
            $max=$bids->where('created_at',$early);
            $user= $max->first()->user;
        }
        else
            $user= $max->first()->user;*/
        try{
            DB::beginTransaction();
            //$max=$max->first();
            //$max->winner=1;
            //$max->save();
            /*Notification::create([
                'user_id'=>$user->id,
                'text'=>'You have won the bid for Auction #'.$this->id,
                'auction_id'=>$this->id
            ]);*/
            $this->status=0;
            $this->save();
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollback();
            dd($e);
        }
    }
}
