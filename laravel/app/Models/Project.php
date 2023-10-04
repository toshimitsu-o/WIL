<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'description',
        'capacity',
        'offer_year',
        'offer_trimester',
        'email',
    ];

    /**
     * Get user assosiated with the project
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get projectfiles assosiated with the project
     */
    public function projectfiles() {
        return $this->hasMany(Projectfile::class);
    }

    /**
     * Get applications assosiated with the project
     */
    public function applications() {
        return $this->hasMany(Application::class);
    }

    /**
     * Get allocations assosiated with the project
     */
    public function allocations() {
        return $this->hasMany(Allocation::class);
    }

    /**
     * Get attributes assosiated with the project
     */
    public function attributes() {
        return $this->belongsToMany(Attribute::class);
    }
}
