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

    function user() {
        return $this->belongsTo(User::class);
    }
}
