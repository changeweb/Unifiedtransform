<?php

namespace App;

use App\Model;

class Issuedbook extends Model
{
    protected $table = 'issued_books';

    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
