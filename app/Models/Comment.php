<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'post_id',
        'parent_id', // include this if you're using parent-child comments (for replies)
    ];

    // 🔹 Each comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
{
    return $this->hasMany(Comment::class, 'parent_id')->with('replies', 'user');
}

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
