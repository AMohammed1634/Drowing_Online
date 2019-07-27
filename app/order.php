<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    public function shoppingCart(){
        return $this->hasMany('App\shoppingCart','order_id','id');
    }
}
