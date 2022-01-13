<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function blogs(){
        return hasMany('App\Blog');
    }
    
    public function follows(){
        return hasMany('App\Follow');
    }
    
    public function follow_users(){
        return belongsToMany('App\User', 'follows', 'user_id', 'follow_id');
    }
    public function folloers(){
        return belongsToMany('App\User', 'follows', 'follow_id', 'user_id');
    }
}
