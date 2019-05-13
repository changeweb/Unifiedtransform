<?php

namespace App;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    public function scopeBySchool($query, int $school_id) {
        return $query->where('school_id', $school_id);
    }
}
