<?php

namespace App;

use App\Model;

class Grade extends Model
{
    /**
     * Get the course record associated with the user.
    */
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    /**
     * Get the student record associated with the user.
    */
    public function student()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Get the teacher record associated with the user.
    */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the exam name record associated with the exam.
    */
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
