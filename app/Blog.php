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
    
    public function scopeSearchBlogs($query, $search_word){
        $search_words = explode(" ", $search_word);
        foreach($search_words as $word){
            $h_search_word = '%' . addcslashes($word, '%_\\') . '%';
            $blogs = $query->where('log', 'like', $h_search_word);
        }
        return $blogs;
    }
}
