<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     if(\Auth::user()->role == 'master') {
        return view('master-home');
      } else {
        $minutes = 1440;// 24 hours = 1440 minutes
        $school_id = \Auth::user()->school->id;
        $classes = \Cache::remember('classes-'.$school_id, $minutes, function () {
          return \App\Myclass::where('school_id', $school_id)
                            ->pluck('id')
                            ->toArray();
        });
        $totalStudents = \Cache::remember('totalStudents-'.$school_id, $minutes, function () {
          return \App\User::where('school_id',$school_id)
                          ->where('role','student')
                          ->count();
        });
        $totalTeachers = \Cache::remember('totalTeachers-'.$school_id, $minutes, function () {
          return \App\User::where('school_id',$school_id)
                          ->where('role','teacher')
                          ->count();
        });
        $totalBooks = \Cache::remember('totalBooks-'.$school_id, $minutes, function () {
          return \App\Book::where('school_id',$school_id)->count();
        });
        $totalClasses = \Cache::remember('totalClasses-'.$school_id, $minutes, function () {
          return \App\Myclass::where('school_id',$school_id)->count();
        });
        $totalSections = \Cache::remember('totalSections-'.$school_id, $minutes, function () use ($classes) {
          return \App\Section::whereIn('class_id', $classes)->count();
        });
        $notices = \Cache::remember('notices-'.$school_id, $minutes, function () {
          return \App\Notice::where('school_id', $school_id)
                            ->where('active',1)
                            ->get();
        });
        $events = \Cache::remember('events-'.$school_id, $minutes, function () {
          return \App\Event::where('school_id', $school_id)
                          ->where('active',1)
                          ->get();
        });
        $routines = \Cache::remember('routines-'.$school_id, $minutes, function () {
          return \App\Routine::where('school_id', $school_id)
                            ->where('active',1)
                            ->get();
        });
        $syllabuses = \Cache::remember('syllabuses-'.$school_id, $minutes, function () {
          return \App\Syllabus::where('school_id', $school_id)
                              ->where('active',1)
                              ->get();
        });
        $exams = \Cache::remember('exams-'.$school_id, $minutes, function () {
          return \App\Exam::where('school_id', $school_id)
                          ->where('active',1)
                          ->get();
        });
        // if(\Auth::user()->role == 'student')
        //   $messageCount = \App\Notification::where('student_id',\Auth::user()->id)->count();
        // else
        //   $messageCount = 0;
        return view('home',[
          'totalStudents'=>$totalStudents,
          'totalTeachers'=>$totalTeachers,
          'totalBooks'=>$totalBooks,
          'totalClasses'=>$totalClasses,
          'totalSections'=>$totalSections,
          'notices'=>$notices,
          'events'=>$events,
          'routines'=>$routines,
          'syllabuses'=>$syllabuses,
          'exams'=>$exams,
          //'messageCount'=>$messageCount,
        ]);
      }
    }
}
