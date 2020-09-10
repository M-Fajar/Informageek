<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name'];

    public function message()
    {
    	return $this->hasMany(Message::class);
    }

    public function user() 
    {
    	return $this->belongsToMany(User::class, 'room_user', 'room_id');
    }
}
