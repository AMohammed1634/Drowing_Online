<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * the relations mapping
     */
    public function role(){
        return $this->belongsTo('App\role','role_id','id');
    }
    public function designProduct(){
        return $this->hasMany('App\product','user_id','id');
    }
    public function wishList(){
        return $this->hasMany('App\wishList','user_id','id');
    }
    public function reviews(){
        return $this->hasMany('App\review','user_id','id');
    }
    public function shoppingCart(){
        return $this->hasMany('App\shoppingCart','user_id','id');
    }
    public function orders(){
        return $this->hasMany('App\order','user_id');
    }
    public function user_info(){
        return $this->hasOne('App\UserInfo','user_id');
    }
}
