<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shoppingCart extends Model
{
    //
    protected $guarded = [];
    public function product(){
        return $this->belongsTo('App\product','product_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function order(){
        return $this->belongsTo('App\order','order_id','id');
    }
}


