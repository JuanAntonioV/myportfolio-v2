<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        'name',
        'url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
