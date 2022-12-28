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
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];

//    /**
//     * The attributes that should be cast.
//     *
//     * @var array<string, string>
//     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    public function detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function contact()
    {
        return $this->hasMany(UserContact::class);
    }

    public function resume()
    {
        return $this->hasMany(UserResume::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function skill()
    {
        return $this->hasMany(Skill::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function loginLog()
    {
        return $this->hasMany(UserLoginLog::class);
    }
}
