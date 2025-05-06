<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Define the relationship with the Like model
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
    return $this->hasMany(Comment::class);
    }

    public function likedByUsers()
    {
    return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps();
    }

    public function category()
   {
    return $this->belongsTo(Category::class);
   }

   public function savedByUsers()
{
    return $this->belongsToMany(User::class, 'post_user_saves')->withTimestamps();
}

}
