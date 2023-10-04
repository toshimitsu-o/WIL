<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'filetype',
        'filepath',
    ];

    /**
     * Get project assosiate with the project file
     */
    public function project() {
        return $this->belongsTo(Project::class);
    }
}
