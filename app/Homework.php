<?php

namespace App;

use App\Model;

class Homework extends Model
{
    protected $table = 'homeworks';
    /**
     * Get the teacher record associated with the user.
    */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }
}
