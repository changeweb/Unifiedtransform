<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Resources\GradeResource;
use Illuminate\Http\Request;
use App\Http\Traits\GradeTrait;
use App\Http\Controllers\Grade\HandleGrade;
class GradeController extends Controller
{
    use GradeTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($student_id)
    {
      if(\Auth::user()->role == 'student'){
        $grades = Grade::with(['student','course','teacher','exam'])
                  ->where('student_id', \Auth::user()->id)
                  ->orderBy('exam_id')
                  ->latest()
                  ->get();
      } else {
        $grades = Grade::with(['student','course','teacher','exam'])
                  ->where('student_id', $student_id)
                  ->orderBy('exam_id')
                  ->latest()
                  ->get();
      }
      if(count($grades) > 0){
        $examIds = $grades->map(function($grade){
          return $grade->exam_id;
        });
        $exams = \App\Exam::whereIn('id', $examIds)
                  ->orderBy('id','desc')
                  ->get();
        $gradesystems = \App\Gradesystem::where('school_id', \Auth::user()->school_id)
                        ->where('grade_system_name',$grades[0]->course->grade_system_name)
                        //->groupBy('grade_system_name')
                        ->get();
      } else {
        $grades = [];
        $gradesystems = [];
        $exams = [];
      }
      return view('grade.student-grade',[
        'grades' => $grades,
        'gradesystems' => $gradesystems,
        'exams' => $exams,
      ]);
    }

    public function tindex($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      
      $grades = Grade::with('course','student')
                ->where('course_id', $course_id)
                ->where('exam_id',$exam_id)
                ->get();
      $gradesystems = \App\Gradesystem::where('school_id', \Auth::user()->school_id)
                      ->groupBy('grade_system_name')
                      ->get();
      return view('grade.teacher-grade',[
        'grades' => $grades,
        'gradesystems' => $gradesystems
      ]);
    }

    public function cindex($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      $grades = Grade::with('course','student')
                ->where('course_id', $course_id)
                ->where('exam_id',$exam_id)
                ->get();
      $gradesystems = \App\Gradesystem::where('school_id', \Auth::user()->school_id)
                      ->groupBy('grade_system_name')
                      ->get();
      return view('grade.course-grade',[
        'grades' => $grades,
        'gradesystems' => $gradesystems,
        'course_id'=>$course_id,
        'exam_id'=>$exam_id,
        'teacher_id'=>$teacher_id
      ]);
    }

    public function allExamsGrade(){
      $classes = \App\Myclass::where('school_id',\Auth::user()->school->id)->get();
      $classIds = $classes->pluck('id')->toArray();
      $sections = \App\Section::whereIn('class_id',$classIds)
                  ->orderBy('section_number')
                  ->get();
      return view('grade.all-exams-grade',[
        'classes'=>$classes,
        'sections'=>$sections
      ]);
    }

    public function gradesOfSection($section_id){
      $examIds = \App\Exam::where('school_id', \Auth::user()->school_id)
                  ->where('active',1)
                  ->pluck('id')
                  ->toArray();
      $courses = \App\Course::where('section_id',$section_id)
                  ->whereIn('exam_id', $examIds)
                  ->pluck('id')
                  ->toArray();
      $grades = Grade::with(['student','course','exam'])
                ->whereIn('course_id', $courses)
                ->get();
      return view('grade.class-result',['grades'=>$grades]);
    }

    public function calculateGpa($gradeSystem, $totalMarks){
      $totalMarks = round($totalMarks);
      foreach($gradeSystem as $gs){
        if($totalMarks > $gs->from_mark && $totalMarks <= $gs->to_mark){
          return $gs->point;
        }
      }
      return 'Something went wrong.';
    }

    public function calculateMarks(Request $request){
      $request->validate([
        'teacher_id' => 'required|numeric',
        'grade_system_name' => 'required|string',
        'exam_id' => 'required|numeric',
        'course_id' => 'required|numeric',
      ]);

      $gradeSystem = \App\Gradesystem::where('school_id', \Auth::user()->school_id)
                      ->where('grade_system_name',$request->grade_system_name)
                      ->get();

      $course = \App\Course::find($request->course_id);

      $grades = Grade::with('course')
                ->where('course_id', $request->course_id)
                ->where('exam_id',$request->exam_id)
                ->get()
                ->toArray();

      foreach($grades as $key => $grade){
        $totalMarks = HandleGrade::calculateMarks($course, $grade);
        // Calculate GPA from Total marks
        $gpa = $this->calculateGpa($gradeSystem, $totalMarks);
        $tb = Grade::find($grade['id']);
        $tb->marks = $totalMarks;
        $tb->gpa = $gpa;
        $tb->save();
      }
      return redirect()->route('teacher-grade', [
        'teacher_id' => $request->teacher_id,
        'course_id'=>$request->course_id,
        'exam_id'=>$request->exam_id
      ]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new GradeResource(Grade::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $tbc = HandleGrade::updateGrade($request);
      try{
          if(count($tbc) > 0)
            \Batch::update('grades',$tbc,'id');
        }catch(\Exception $e){
            return "OOps, an error occured";
        }

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
      return (Grade::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
