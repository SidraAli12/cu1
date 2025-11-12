<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'track_id',
        'topic',
    ];

    
    public function course()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
