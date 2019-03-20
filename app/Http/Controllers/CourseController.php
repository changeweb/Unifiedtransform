<?php

namespace App\Http\Controllers;

use App\Course as Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Http\Traits\GradeTrait;

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
        $courses = Course::with(['section', 'teacher','exam'])
                        ->where('teacher_id', $teacher_id)
                        ->get();
        $exams = \App\Exam::where('school_id', \Auth::user()->school_id)
                          ->where('active',1)
                          ->get();

        return view('course.teacher-course',['courses'=>$courses,'exams'=>$exams]);

      }else if(\Auth::user()->role == 'student'
                && $section_id == \Auth::user()->section_id
                && $section_id > 0)
      {
        $courses = Course::with(['section', 'teacher'])
                        ->where('section_id', $section_id)
                        ->get();

        return view('course.class-course',['courses'=>$courses,'exams'=>[]]);

      }else if(\Auth::user()->role != 'student' && $section_id > 0) {

        $courses = Course::with(['section', 'teacher','exam'])
                        ->where('section_id', $section_id)
                        ->get();
        $exams = \App\Exam::where('school_id', \Auth::user()->school_id)
                          ->where('active',1)
                          ->get();
        
        return view('course.class-course',['courses'=>$courses,'exams'=>$exams]);
      } else {
        return redirect('home');
      }
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
      $students = \App\Grade::with('student')
                            ->where('course_id', $course_id)
                            ->where('exam_id',$exam_id)
                            ->get();
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
      $tb = new Course;
      $tb->course_name = $request->course_name;
      $tb->class_id = $request->class_id;
      $tb->course_type = $request->course_type;
      $tb->course_time = $request->course_time;
      $tb->section_id = $request->section_id;
      $tb->teacher_id = $request->teacher_id;
      $tb->exam_id = 0;
      // $tb->user_id = $request->user_id;
      // $tb->quiz_percent = $request->quiz_percent;
      // $tb->test_percent = $request->test_percent;
      // $tb->assignment_percent = $request->assignment_percent;
      // $tb->class_work_percent = $request->class_work_percent;
      // $tb->final_exam_percent = $request->final_exam_percent;
      $tb->save();
      return back()->with('status', 'Created');
    }

    public function saveConfiguration(Request $request){
      $request->validate([
        'grade_system_name' => 'required|string',
        'quiz_count' => 'required|numeric|min:0|max:5',
        'assignment_count' => 'required|numeric|min:0|max:3',
        'ct_count' => 'required|numeric|min:0|max:5',
        'quiz_perc' => 'required|numeric|min:0|max:100',
        'attendance_perc' => 'required|numeric|min:0|max:100',
        'assign_perc' => 'required|numeric|min:0|max:100',
        'ct_perc' => 'required|numeric|min:0|max:100',
        'final_perc' => 'required|numeric|min:0|max:100',
        'practical_perc' => 'required|numeric|min:0|max:100',
        'att_fullmark' => 'required|numeric|min:0|max:100',
        'quiz_fullmark' => 'required|numeric|min:0|max:100',
        'assignment_fullmark' => 'required|numeric|min:0|max:100',
        'ct_fullmark' => 'required|numeric|min:0|max:100',
        'final_fullmark' => 'required|numeric|min:0|max:100',
        'practical_fullmark' => 'required|numeric|min:0|max:100',
      ]);
      $tb = Course::find($request->course_id);
      $tb->grade_system_name = $request->grade_system_name;
      $tb->quiz_count = $request->quiz_count;
      $tb->assignment_count = $request->assignment_count;
      $tb->ct_count = $request->ct_count;
      $tb->quiz_percent = $request->quiz_perc;
      $tb->attendance_percent = $request->attendance_perc;
      $tb->assignment_percent = $request->assign_perc;
      $tb->ct_percent = $request->ct_perc;
      $tb->final_exam_percent = $request->final_perc;
      $tb->practical_percent = $request->practical_perc;
      $tb->att_fullmark = $request->att_fullmark;
      $tb->quiz_fullmark = $request->quiz_fullmark;
      $tb->a_fullmark = $request->assignment_fullmark;
      $tb->ct_fullmark = $request->ct_fullmark;
      $tb->final_fullmark = $request->final_fullmark;
      $tb->practical_fullmark = $request->practical_fullmark;
      $tb->save();
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
    // public function update(Request $request)
    // {
    //   $request->validate([
    //     'course_id' => 'required|numeric',
    //     'exam_id' => 'required|numeric',
    //   ]);
    //   $tb = Course::find($request->course_id);
    //   $tb->exam_id = $request->exam_id;
    //   $tb->save();
    //   return back()->with('status', 'Saved');
    // }

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
