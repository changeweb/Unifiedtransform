<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentBoardExam extends Model
{
    protected $table = 'student_board_exams';
    /**
     * Get the student record associated with the user.
    */
    public function student()
    {
        return $this->belongsTo('App\User');
    }
}
