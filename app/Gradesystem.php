<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradesystem extends Model
{
    protected $table = 'grade_systems';

    public function school()
    {
        return $this->belongsTo('App\School');
    }
}
