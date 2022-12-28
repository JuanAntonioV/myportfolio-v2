<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPath extends Model
{
    use HasFactory;

    protected $table = 'project_paths';

    protected $fillable = [
        'project_id',
        'name',
        'url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
