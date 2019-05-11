<?php

namespace App;

use App\Model;

class Course extends Model
{
    /**
     * Get the class record associated with the user.
    */
    public function class()
    {
        return $this->belongsTo('App\Myclass');
    }
    /**
     * Get the section record associated with the user.
    */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }
    /**
     * Get the teacher record associated with the user.
    */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }
     /**
     * Get the exam record associated with the course.
    */
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
