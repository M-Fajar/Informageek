<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['post_id','user_id'];
    
    public function posts(){
        return $this->belongsTo('App\Post');
    }
}
