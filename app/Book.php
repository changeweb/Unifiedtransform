<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'book_code', 'author', 'quantity', 'rackNo', 'rowNo', 'type',
        'about', 'price', 'img_path', 'class_id', 'school_id', 'user_id'
    ];

    public function school() {
        return $this->belongsTo('App\School');
    }

    public function class() {
        return $this->belongsTo('App\Myclass');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function issuedbook() {
        return $this->hasMany('App\Issuedbook', 'book_id');
    }

    public function scopeBySchool($query, int $school_id) {
        return $query->where('school_id', $school_id);
    }
}
