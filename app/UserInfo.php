<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $guarded = [];
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
