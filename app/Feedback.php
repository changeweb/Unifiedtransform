<?php

namespace App;

use App\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
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
}
