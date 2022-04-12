<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_marks',
        'pass_marks',
        'marks_distribution_note',
        'exam_id',
        'session_id'
    ];
}
