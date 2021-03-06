<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'role' => 'user',
        'foto' => 'default.png',
        'cover'=> 'default.jpg'
     ];
    protected $fillable = [
        'name', 'email', 'password','username','role','foto','cover','bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','role','email','email_verified_at','token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function room()
    {
        return $this->belongsToMany(Room::class, 'room_user');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    
}
