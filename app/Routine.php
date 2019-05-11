<?php

namespace App;

use App\Model;

class Routine extends Model
{
    /**
     * Get the school record associated with the user.
    */
    public function school()
    {
        return $this->belongsTo('App\School');
    }
    /**
     * Get the Section record associated with the Routine.
    */
    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
