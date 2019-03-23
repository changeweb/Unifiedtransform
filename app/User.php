<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'code',/* school code*/'student_code', 'active', 'verified', 'school_id', 'section_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function studentInfo(){
        return $this->hasOne('App\StudentInfo','student_id');
    }

    public function studentBoardExam(){
        return $this->hasMany('App\StudentBoardExam','student_id');
    }

    public function notifications(){
        return $this->hasMany('App\Notification','student_id');
    }
}
