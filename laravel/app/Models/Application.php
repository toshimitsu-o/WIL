<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'justification',
    ];

    /**
     * Get user assosiated with the application
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get project assosiated with the application
     */
    public function project() {
        return $this->belongsTo(Project::class);
    }
}
