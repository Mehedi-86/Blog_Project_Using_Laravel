<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['post_id', 'reported_by', 'user_id', 'report_type'];

    // The post that was reported
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // The user who reported the post
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    // Alias for 'reporter' – optional if you prefer using reportedBy()
    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    // The user who owns the post (i.e., the reported user)
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
