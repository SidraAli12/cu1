<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    // if your table name is not 'questions', set protected $table = 'your_table_name';

    protected $fillable = [
        'quiz_id',
        'question',
        'path',         // optional (for media)
        'marks',
        'complexity',
        'question_type' // e.g. 'mcq'|'text'
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
