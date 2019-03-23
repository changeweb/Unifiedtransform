<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'about', 'medium', 'code', 'theme',
    ];

  public function users()
  {
    return $this->hasMany('App\User');
  }

  public function departments()
  {
    return $this->hasMany('App\Department');
  }
}
