<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'calculated_marks',
        'final_marks',
        'note',
        'student_id',
        'class_id',
        'section_id',
        'course_id',
        'semester_id',
        'session_id'
    ];

    /**
     * Get the student for attendances.
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
