<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersFooter extends Model
{
    use HasFactory;

    protected $table = 'users_footer'; // <--- add this line

    protected $fillable = [
        'user_id',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
