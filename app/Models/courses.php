<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

   
    protected $fillable = [
       'subject_id', 'track_id', 'course', 
    ];

    
    public function topics()
    {
        return $this->hasMany(Topic::class, 'course_id');
    }
}
