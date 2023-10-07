<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
        'gpa',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get projects assosiated with the user
     */
    public function projects() {
        return $this->hasMany(Project::class);
    }

    /**
     * Get applications assosiated with the user
     */
    public function applications() {
        return $this->hasMany(Application::class);
    }

    /**
     * Get allocation assosiated with the user
     */
    public function allocation() {
        return $this->belongsTo(Allocation::class);
    }

    /**
     * Get attributes assosiated with the user
     */
    public function attributes() {
        return $this->belongsToMany(Attribute::class, 'user_attribute');
    }

    /**
     * Get all users with the usertype
     * 
     * @param string Usertype
     */
    public static function users_by_type($usertype) {
        return self::where('usertype', $usertype)->paginate(5);
    }


}
