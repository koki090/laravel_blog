<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id', 'title', 'log'];
        
    public function users(){
        return belongsTo('App\User');
    }
}
