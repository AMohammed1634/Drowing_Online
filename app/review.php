<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    //
    protected $guarded = [];
    public function product(){
        return $this->belongsTo('App\product','product_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
