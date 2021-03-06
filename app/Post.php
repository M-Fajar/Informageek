<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'category_id', 'thumbnail'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function thumbnails()
    {
        return $this->hasMany(Thumbnail::class);
    }

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->thumbnails;
    }
    public function comments()
    {
    return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
    public function likes()
    {
    return $this->hasMany(Like::class);
    }
}
