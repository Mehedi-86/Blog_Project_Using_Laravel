<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Define the relationship with the Like model
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
    return $this->hasMany(Comment::class);
    }

}
