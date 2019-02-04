<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //

    protected  $guarded=[];


    public function getImage(){
        return '/storage/'.$this->path;
    }
}
