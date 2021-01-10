<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];
    
    public function posts()
    {
    	return $this->belongsToMany(Post::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
