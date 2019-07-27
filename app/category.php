<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    public function product(){
        return $this->hasMany('App\product','category_id','id');
    }
}
