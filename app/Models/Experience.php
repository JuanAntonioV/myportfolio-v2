<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experiences';

    protected $fillable = [
        'user_id',
        'title',
        'company',
        'status',
        'started_at',
        'ended_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experienceJobdesk()
    {
        return $this->hasMany(ExperienceJobdesk::class);
    }
}
