<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * Get users assosiated with the attribute
     */
    public function users() {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get projects assosiated with the attribute
     */
    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
