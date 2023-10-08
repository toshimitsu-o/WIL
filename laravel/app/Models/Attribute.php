<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public $timestamps = false;
    
    use HasFactory;

    protected $fillable = [
        'name',
        'attributetype',
    ];

    /**
     * Get users assosiated with the attribute
     */
    public function users() {
        return $this->belongsToMany(User::class, 'user_attribute');
    }

    /**
     * Get projects assosiated with the attribute
     */
    public function projects() {
        return $this->belongsToMany(Project::class, 'project_attribute');
    }
}
