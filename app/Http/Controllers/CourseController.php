<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Http\Requests\Course\SaveConfigurationRequest;
use App\Http\Traits\GradeTrait;
use App\Http\Controllers\Course\HandleCourse;

class CourseController extends Controller
{
    use GradeTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacher_id, $section_id){
      if(\Auth::user()->role != 'student' && $teacher_id > 0) {
        $courses = HandleCourse::getCoursesByTeacher($teacher_id);
        $exams = \App\Exam::where('school_id', \Auth::user()->school_id)
                          ->where('active',1)
                          ->get();
        $view = 'course.teacher-course';

      } else if(\Auth::user()->role == 'student'
                && $section_id == \Auth::user()->section_id
                && $section_id > 0) {
        $courses = HandleCourse::getCoursesBySection($section_id);
        $view = 'course.class-course';
        $exams = [];

      } else if(\Auth::user()->role != 'student' && $section_id > 0) {
        $courses = HandleCourse::getCoursesBySection($section_id);
        $exams = \App\Exam::where('school_id', \Auth::user()->school_id)
                          ->where('active',1)
                          ->get();
        $view = 'course.class-course';
      } else {
        return redirect('home');
      }
      return view($view,['courses'=>$courses,'exams'=>$exams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      $students = HandleCourse::getStudentsFromGradeByCourseAndExam($course_id, $exam_id);
      return view('course.students', [
        'students'=>$students,
        'teacher_id'=>$teacher_id,
        'section_id'=>$section_id,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        HandleCourse::addCourse($request);
      } catch (\Exception $ex){
        return 'Could not add course.';
      }
      return back()->with('status', 'Created');
    }

    /**
     * @param SaveConfigurationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveConfiguration(SaveConfigurationRequest $request){
      try{
        HandleCourse::saveConfiguration($request);
      } catch (\Exception $ex){
        return 'Could not save configuration.';
      }
      return back()->with('status', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return new CourseResource(Course::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $course = Course::find($id);
      return view('course.edit', ['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNameAndTime(Request $request, $id)
    {
      $request->validate([
        'course_name' => 'required|string',
        'course_time' => 'required|string',
      ]);
      $tb = Course::find($id);
      $tb->course_name = $request->course_name;
      $tb->course_time = $request->course_time;
      $tb->save();
      return back()->with('status', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Course::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
