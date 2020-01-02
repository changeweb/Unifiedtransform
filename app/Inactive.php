<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Reinstate;
// use App\Users;


class Inactive extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

   
}
