<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'body',
    ];

    // Relationship: Each comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: Each comment belongs to a post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
