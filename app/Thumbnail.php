<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
    public function post()
    {
    	return $this->belongsTo(Post::class);
    } 
}
