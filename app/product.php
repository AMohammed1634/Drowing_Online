<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    public function category(){
        return $this->belongsTo('App\category','category_id','id');
    }
    public function design(){
        return $this->belongsTo('App\User','user_id','id');
    }
    public function wishList(){
        return $this->hasMany('App\wishList','product_id','id');
    }
    public function reviews (){
        return $this->hasMany('App\review','product_id','id');
    }
    public function shoppingCart(){
        return $this->hasMany('App\shoppingCart','product_id','id');
    }
}
