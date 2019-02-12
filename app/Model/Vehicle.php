<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //

    protected  $guarded=[];

    public function auction(){
        return $this->belongsTo('App\Model\Auction');
    }

    public function getDescriptions(){
        $exploed=explode('_',$this->vehicle_description);
        $keys=[];

        $values=[];
        foreach ($exploed as $e){
            $temp=explode('-',$e);
            array_push($keys,$temp[0]);
            array_push($values,$temp[1]);
        }
        $obj= new \stdClass();
        $obj->keys=$keys;
        $obj->values=$values;
        return $obj;
    }
}
