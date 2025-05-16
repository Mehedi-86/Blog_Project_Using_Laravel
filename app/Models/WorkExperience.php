<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    // Allow mass assignment for these attributes
    protected $fillable = [
        'user_id',
        'workplace_name',
        'workplace_logo',
        'designation', 
        'year',        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

