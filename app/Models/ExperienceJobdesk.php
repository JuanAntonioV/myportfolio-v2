<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceJobdesk extends Model
{
    use HasFactory;

    protected $table = 'experience_jobdesks';

    protected $fillable = [
        'experience_id',
        'jobdesk',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
