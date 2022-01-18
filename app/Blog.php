<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id', 'title', 'log'];
        
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function scopeMyBlog($query,$not_follow_users_id){
        $query->whereNotIn('user_id',$not_follow_users_id)->orderBy('created_at','desc');
    }
    
}
