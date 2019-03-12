<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    /**
     * Get the teacher record associated with the user.
    */
    public function teacher()
    {
        return $this->belongsTo('App\User');
    }
}
