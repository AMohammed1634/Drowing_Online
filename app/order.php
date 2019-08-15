<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected  $guarded = [];
    public function shoppingCart(){
        return $this->hasMany('App\shoppingCart','order_id','id');
    }
}
