<?php

namespace App;

use App\Model;

class StudentInfo extends Model
{
    protected $table = 'student_infos';
    protected $fillable = array('student_id');
    /**
     * Get the student record associated with the user.
    */
    public function student()
    {
        return $this->belongsTo('App\User');
    }

    public function house()
    {
        return $this->belongsTo('App\House');
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'form_id');
    }

    public function channel()
    {
        return $this->belongsTo('App\FeeChannel', 'channel_id');
    }
}
