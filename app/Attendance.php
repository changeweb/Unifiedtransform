<?php

namespace App;

use App\Model;

class Attendance extends Model
{
    /**
     * Get the student record associated with the user.
    */
    public function student()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the section record associated with the attendance.
    */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    /**
     * Get the exam record associated with the attendance.
    */
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
