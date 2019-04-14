<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "books";

    public function school(){
        return $this->belongsTo('App\School');
    }
    /**
     * Get the class record associated with the user.
    */
    public function class()
    {
        return $this->belongsTo('App\Myclass');
    }
    /**
     * Get the student record associated with the user.
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the student record associated with the user.
    */
    public function issuedbook()
    {
        return $this->hasMany('App\Issuedbook', 'book_id');
    }

    /**
    * Scope a query to only include books by school.
    *
    * @param  \Illuminate\Database\Eloquent\Builder  $query
    * @param  int  $school_id
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeBySchool($query, int $school_id) {
        return $query->where('school_id', $school_id);
    }
}
