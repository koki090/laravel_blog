<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    protected $fillable = [
        'blog_id', 'image'];
        
    public function blog(){
        $this->belongsTo('App\Blog');
    }
}
