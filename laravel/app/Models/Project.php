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
        return $this->belongsToMany(Attribute::class, 'project_attribute');
    }

    /**
     * Get distinct offer_years
     */
    public static function offer_years() {
        return self::distinct()->orderBy('offer_year', 'asc')->get(['offer_year']);
    }

    /**
     * Get distinct offer_years
     */
    public static function offer_trimesters() {
        return self::distinct()->orderBy('offer_trimester', 'asc')->get(['offer_trimester']);
    }

    public function check_name_duplicate($year, $trimester) {
        $projects = Project::where('offer_year', $year)->where('offer_trimester', $trimester)->where('name', $this->name)->get();
        return count($projects) > 0;
    }
}
