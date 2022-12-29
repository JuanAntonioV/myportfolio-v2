<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'user_id',
        'title',
        'detail',
        'type',
        'image',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectTechnologie()
    {
        return $this->hasMany(ProjectTechnologie::class);
    }

    public function projectPath()
    {
        return $this->hasMany(ProjectPath::class);
    }
}
