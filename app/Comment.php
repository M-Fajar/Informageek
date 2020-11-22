<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   

    protected $fillable = ['post_id','user_id','comment','parent_id'];
    //
    public function child()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
    public function posts(){
        return $this->belongsTo('App\Post');
    }
}
