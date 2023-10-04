<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
    ];

    /**
     * Get user assosiated with the allocation
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get project assosiated with the allocation
     */
    public function project() {
        return $this->belongsTo(Project::class);
    }
}
