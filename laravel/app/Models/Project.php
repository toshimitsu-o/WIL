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
     * Get user assosiate with the project
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get projectfiles assosiate with the project
     */
    public function projectfiles() {
        return $this->hasMany(Projectfile::class);
    }

    /**
     * Get applications assosiate with the project
     */
    public function applications() {
        return $this->hasMany(Application::class);
    }
}
