<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtraCurricularActivity extends Model
{
    protected $fillable = [
        'user_id', 'name', 'logo', 'time_duration', 'description', 'github_link'
    ];    
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
