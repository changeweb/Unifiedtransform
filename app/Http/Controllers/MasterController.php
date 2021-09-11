<?php

namespace App\Http\Controllers;
use App\School;
use App\User;
use Illuminate\Http\Request;

class MasterController extends Controller
{

    public function index() {
        $school_count = count(School::all());
        $teachers = count(User::where('role', 'teacher')->get());
        $students = count(User::where('role', 'student')->get());
        $admins = count(User::where('role', 'admin')->get());
        return view('masters.index',[
            'school_count'=>$school_count,
            'teachers_count'=>$teachers,
            'students_count'=>$students,
            'admins_count'=>$admins,
        ]);
    }
}
