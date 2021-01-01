<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    protected $fillable = ['follower_id','following_id'];


    
}
