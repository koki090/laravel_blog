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
        return $this->hasMany('App\Blog');
    }
    
    public function follows(){
        return $this->hasMany('App\Follow');
    }
    
    public function follow_users(){
        return $this->belongsToMany('App\User', 'follows', 'user_id', 'follow_id');
    }
    public function followers(){
        return $this->belongsToMany('App\User', 'follows', 'follow_id', 'user_id');
    }
    
    public function isFollowUser($id){
        return $this->follow_users()->get()->contains('id', $id);
    }
    
    public function not_follow_users(){
         $follow_users_id = User::find($this->id)->follow_users()->pluck('follow_id');
         return  User::all()->whereNotIn('id', $follow_users_id)->whereNotIn('id', $this->id);
    }
    
    public function recommend_users(){
        $not_follow_users_id = $this->not_follow_users()->pluck('id');
        $number_of_displays = 0;
        if($not_follow_users_id->count() > 3){
            $number_of_displays = 3;
        }else{
            $number_of_displays = $not_follow_users_id->count();
        }
        return $this->not_follow_users()->random($number_of_displays);
    }
}
