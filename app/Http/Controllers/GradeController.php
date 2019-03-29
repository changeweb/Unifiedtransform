<?php

namespace App\Http\Controllers;

use App\Grade as Grade;
use App\Http\Resources\GradeResource;
use Illuminate\Http\Request;
use App\Http\Traits\GradeTrait;

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

      $quizCount = $course->quiz_count;
      $assignmentCount = $course->assignment_count;
      $ctCount = $course->ct_count;
      $attPerc = $course->attendance_percent;
      $assignPerc = $course->assignment_percent;
      $quizPerc = $course->quiz_percent;
      $ctPerc = $course->ct_percent;
      $finalExamPerc = $course->final_exam_percent;

      $grades = Grade::with('course')
                ->where('course_id', $request->course_id)
                ->where('exam_id',$request->exam_id)
                ->get()
                ->toArray();

      foreach($grades as $key => $grade){
        $quizSum = 0; $assignmentSum = 0; $ctSum = 0;
        // Quiz
        if($quizCount > 0){
          $quizGradeArray = array();
          for($i=1; $i<=5; $i++){
            array_push($quizGradeArray,$grade["quiz$i"]);
          }
          rsort($quizGradeArray);
          $largest = array_slice($quizGradeArray, 0, $quizCount);

          foreach($largest as $q){
            $quizSum += $q;
          }
        } else {
          for($i=1; $i<=5; $i++){
            $quizSum += $grade["quiz$i"];
          }
        }
        
        // Assignment
        if($assignmentCount > 0){
          $assignmentGradeArray = array();
          for($i=1; $i<=3; $i++){
            array_push($assignmentGradeArray,$grade["assignment$i"]);
          }
          rsort($assignmentGradeArray);
          $largest = array_slice($assignmentGradeArray, 0, $assignmentCount);

          foreach($largest as $a){
            $assignmentSum += $a;
          }
        } else {
          for($i=1; $i<=3; $i++){
            $assignmentSum += $grade["assignment$i"];
          }
        }
        
        // Class Test
        if($ctCount > 0){
          $ctGradeArray = array();
          for($i=1; $i<=5; $i++){
            array_push($ctGradeArray,$grade["ct$i"]);
          }
          rsort($ctGradeArray);
          $largest = array_slice($ctGradeArray, 0, $ctCount);

          foreach($largest as $c){
            $ctSum += $c;
          }
        } else {
          for($i=1; $i<=5; $i++){
            $ctSum += $grade["ct$i"];
          }
        }
        
        // Percentage related calculation
        
        if($course->att_fullmark > 0){
          $final_att_mark = ($attPerc*$grade['attendance'])/($course->att_fullmark);
        } else {
          $final_att_mark = $grade['attendance'];
        }

        if($course->quiz_fullmark > 0){
          $avgQuizSum = $quizSum/$quizCount;
          $final_quiz_mark = ($quizPerc*$avgQuizSum)/($course->quiz_fullmark);
        } else {
          $final_quiz_mark = $quizSum;
        }

        if($course->a_fullmark > 0){
          $avgAssignSum = $assignmentSum/$assignmentCount;
          $final_assignment_mark = ($assignPerc*$avgAssignSum)/($course->a_fullmark);
        } else {
          $final_assignment_mark = $assignmentSum;
        }

        if($course->ct_fullmark > 0){
          $avgCTSum = $ctSum/$ctCount;
          $final_ct_mark = ($ctPerc*$avgCTSum)/($course->ct_fullmark);
        } else {
          $final_ct_mark = $ctSum;
        }

        if($course->final_fullmark > 0){
          $final_finalExam_mark = ($finalExamPerc*($grade['written']+$grade['mcq']))/($course->final_fullmark);
        } else {
          $final_finalExam_mark = $grade['written']+$grade['mcq'];
        }

        if($course->practical_fullmark > 0){
          $final_practical_mark = ($course->practical_percent*$grade['practical'])/($course->practical_fullmark);
        } else {
          $final_practical_mark = $grade['practical'];
        }
        // Calculate total marks
        $totalMarks = round((round($final_att_mark, 8, 2)+round($final_quiz_mark, 8, 2)+round($final_assignment_mark, 8, 2)+round($final_ct_mark, 8, 2)+round($final_finalExam_mark, 8, 2)+round($final_practical_mark, 8, 2)), 8, 2);
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
      $i = 0;
      foreach($request->grade_ids as $id){
        $tb = Grade::find($id);
        $tb->attendance = $request->attendance[$i];
        $tb->quiz1 = $request->quiz1[$i];
        $tb->quiz2 = $request->quiz2[$i];
        $tb->quiz3 = $request->quiz3[$i];
        $tb->quiz4 = $request->quiz4[$i];
        $tb->quiz5 = $request->quiz5[$i];
        $tb->assignment1 = $request->assign1[$i];
        $tb->assignment2 = $request->assign2[$i];
        $tb->assignment3 = $request->assign3[$i];
        $tb->ct1 = $request->ct1[$i];
        $tb->ct2 = $request->ct2[$i];
        $tb->ct3 = $request->ct3[$i];
        $tb->ct4 = $request->ct4[$i];
        $tb->ct5 = $request->ct5[$i];
        $tb->written = $request->written[$i];
        $tb->mcq = $request->mcq[$i];
        $tb->practical = $request->practical[$i];
        $tb->user_id = \Auth::user()->id;
        $tb->created_at = date('Y-m-d H:i:s');
        $tb->updated_at = date('Y-m-d H:i:s');
        $tbc[] = $tb->attributesToArray();
        $i++;
      }
      
      try{
          if(count($tbc) > 0)
            Grade::insert($tbc);
        }catch(\Exception $e){
            return false;
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
