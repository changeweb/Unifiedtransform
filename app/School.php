<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
  public function users()
  {
    return $this->hasMany('App\User');
  }

  public function departments()
  {
    return $this->hasMany('App\Department');
  }
}
