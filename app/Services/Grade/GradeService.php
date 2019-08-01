<?php
namespace App\Services\Grade;

use App\Grade;
use App\Gradesystem;
use App\Exam;
use App\Course;
use App\Section;
use App\Myclass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GradeService {

  public $grades;
  public $gradesystems;
  public $course_id;
  public $exam_id;
  public $teacher_id;
  public $section_id;
  public $exams;
  // Calculation marks starts
  public $final_att_mark;
  public $final_assignment_mark;
  public $final_quiz_mark;
  public $final_ct_mark;
  public $final_finalExam_mark;
  public $final_practical_mark;
  public $quizCount;
  public $assignmentCount;
  public $ctCount;
  public $quizSum;
  public $assignmentSum;
  public $ctSum;
  public $field;
  public $grade;
  public $maxFieldNum;
  public $fieldCount;
  public $full_field_mark;
  public $field_percentage;
  public $avg_field_sum;
  public $final_default_value;
  // Calculation marks ends

  public function isLoggedInUserStudent(){
    return auth()->user()->role == 'student';
  }

  public function getExamByIdsFromGrades($grades){
    $examIds = $grades->map(function($grade){
      return $grade->exam_id;
    });
    $exams = Exam::whereIn('id', $examIds)
                  ->orderBy('id','desc')
                  ->get();
    return $exams;
  }

  public function getStudentGradesWithInfoCourseTeacherExam($student_id){
    return Grade::with(['student','course','teacher','exam'])
                  ->where('student_id', $student_id)
                  ->orderBy('exam_id')
                  ->latest()
                  ->get();
  }

  public function getGradeSystemBySchoolId($grades){
    $grade_system_name = isset($grades[0]->course->grade_system_name) ? $grades[0]->course->grade_system_name : false;
    return ($grade_system_name)?Gradesystem::where('school_id', auth()->user()->school_id)
                        ->where('grade_system_name', $grade_system_name)
                        //->groupBy('grade_system_name')
                        ->get() : Gradesystem::select('grade_system_name')
                        ->where('school_id', auth()->user()->school_id)
                        ->distinct()
                        ->get();
  }

  public function getGradeSystemByname($grade_system_name){
    return Gradesystem::where('school_id', auth()->user()->school_id)
                        ->where('grade_system_name', $grade_system_name)
                        ->get();
  }

  public function gradeIndexView($view){
    return view($view,[
        'grades' => $this->grades,
        'gradesystems' => $this->gradesystems,
        'exams' => $this->exams,
      ]);
  }

  public function getGradeSystemBySchoolIdGroupByName($grades){
    $grade_system_name = isset($grades[0]->course->grade_system_name) ? $grades[0]->course->grade_system_name : false;
    
    return ($grade_system_name)?Gradesystem::where('school_id', auth()->user()->school_id)
                        ->where('grade_system_name', $grade_system_name)
                        //->groupBy('grade_system_name')
                        ->get() : Gradesystem::select('grade_system_name')
                        ->where('school_id', auth()->user()->school_id)
                        ->distinct()
                        ->get();
  }

  public function gradeTeacherIndexView($view){
    return view($view,[
        'grades' => $this->grades,
        'gradesystems' => $this->gradesystems
      ]);
  }

  public function gradeCourseIndexView($view){
    return view($view,[
        'grades' => $this->grades,
        'gradesystems' => $this->gradesystems,
        'course_id' => $this->course_id,
        'exam_id' => $this->exam_id,
        'teacher_id' => $this->teacher_id,
        'section_id' => $this->section_id,
      ]);
  }

  public function getGradesByCourseExam($course_id, $exam_id){
    return Grade::with('course','student')
                ->where('course_id', $course_id)
                ->where('exam_id',$exam_id)
                ->get();
  }

  public function calculateGpaFromTotalMarks($grades, $course, $gradeSystem){
    foreach($grades as $key => $grade){
        $totalMarks = $this->calculateMarks($course, $grade);
        // Calculate GPA from Total marks
        $gpa = $this->calculateGpa($gradeSystem, $totalMarks);
        $tb = Grade::find($grade['id']);
        $tb->marks = $totalMarks;
        $tb->gpa = $gpa;
        $tbc[] = $tb->attributesToArray();
    }
    return $tbc;
  }

  public function getActiveExamIds(){
    return Exam::where('school_id', auth()->user()->school_id)
                  ->where('active',1)
                  ->pluck('id');
  }

  public function getCourseBySectionIdExamIds($section_id, $examIds){
    return Course::where('section_id',$section_id)
                  ->whereIn('exam_id', $examIds)
                  ->pluck('id')
                  ->toArray();
  }

  public function getGradesByCourseId($courses){
    return Grade::with(['student','course','exam'])
                ->whereIn('course_id', $courses)
                ->get();
  }

  public function getClassesBySchoolId(){
    return Myclass::where('school_id',auth()->user()->school->id)->get();
  }

  public function getSectionsByClassIds($classIds){
    return Section::whereIn('class_id',$classIds)
                  ->orderBy('section_number')
                  ->get();
  }

  public function getCourseByCourseId(){
    return Course::find($this->course_id);
  }

  public function saveCalculatedGPAFromTotalMarks($tbc){
    try{
      if(count($tbc) > 0)
        return \Batch::update('grades',(array) $tbc,'id');
    }catch(\Exception $e){
      return "OOps, an error occured";
    }
  }

    public function calculateMarks($course, $grade){
        $this->grade = $grade;

        $this->quizCount = $course->quiz_count;
        $this->assignmentCount = $course->assignment_count;
        $this->ctCount = $course->ct_count;

        // Quiz
        $this->field = 'quiz';
        $this->fieldCount = $this->quizCount;
        $this->maxFieldNum = 5;
        $this->quizSum = $this->getMarkSum();
        // Assignment
        $this->field = 'assignment';
        $this->fieldCount = $this->assignmentCount;
        $this->maxFieldNum = 3;
        $this->assignmentSum = $this->getMarkSum();
        // Class Test
        $this->field = 'ct';
        $this->fieldCount = $this->ctCount;
        $this->maxFieldNum = 5;
        $this->ctSum = $this->getMarkSum();
        
        // Percentage related calculation
        // Attendance
        $this->full_field_mark = $course->att_fullmark;
        $this->field_percentage = $course->attendance_percent;
        $this->avg_field_sum = $this->grade['attendance'];
        $this->final_default_value = $this->grade['attendance'];
        $this->final_att_mark = $this->getFieldFinalMark();
        // Quiz
        $this->full_field_mark = $course->quiz_fullmark;
        $this->field_percentage = $course->quiz_percent;
        $this->avg_field_sum = $this->quizCount > 0 ? $this->quizSum/$this->quizCount : 0;
        $this->final_default_value = $this->quizSum;
        $this->final_quiz_mark = $this->getFieldFinalMark();
        // Assignment
        $this->full_field_mark = $course->a_fullmark;
        $this->field_percentage = $course->assignment_percent;
        $this->avg_field_sum = $this->assignmentCount > 0 ? $this->assignmentSum/$this->assignmentCount : 0;
        $this->final_default_value = $this->assignmentSum;
        $this->final_assignment_mark = $this->getFieldFinalMark();
        // Class Test
        $this->full_field_mark = $course->ct_fullmark;
        $this->field_percentage = $course->ct_percent;
        $this->avg_field_sum = $this->ctCount > 0 ? $this->ctSum/$this->ctCount : 0;
        $this->final_default_value = $this->ctSum;
        $this->final_ct_mark = $this->getFieldFinalMark();
        // Final Exam
        $this->full_field_mark = $course->final_fullmark;
        $this->field_percentage = $course->final_exam_percent;
        $this->avg_field_sum = ($this->grade['written']+$this->grade['mcq']);
        $this->final_default_value = $this->grade['written']+$this->grade['mcq'];
        $this->final_finalExam_mark = $this->getFieldFinalMark();
        // Practical
        $this->full_field_mark = $course->practical_fullmark;
        $this->field_percentage = $course->practical_percent;
        $this->avg_field_sum = $this->grade['practical'];
        $this->final_default_value = $this->grade['practical'];
        $this->final_practical_mark = $this->getFieldFinalMark();
        
        // Calculate total marks
        $totalMarks = $this->getTotalCalculatedMarks();

        return $totalMarks;
    }

    public function getMarkSum(){
      $fieldSum = 0;
      if($this->fieldCount > 0){
          $fieldGradeArray = array();
          for($i=1; $i<=$this->maxFieldNum; ++$i){
            array_push($fieldGradeArray,$this->grade["{$this->field}{$i}"]);
          }
          rsort($fieldGradeArray);
          $largest = array_slice($fieldGradeArray, 0, $this->fieldCount);

          foreach($largest as $l){
            $fieldSum += $l;
          }
        } else {
          for($i=1; $i<=5; ++$i){
            if (isset($this->grade["{$this->field}{$i}"]))
              $fieldSum += $this->grade["{$this->field}{$i}"];
          }
        }
      return $fieldSum;
    }

    public function getFieldFinalMark(){
      return ($this->full_field_mark > 0)? (($this->field_percentage*$this->avg_field_sum)/$this->full_field_mark) : $this->final_default_value;
    }
      
    public function getTotalCalculatedMarks(){
      return round(
        (round($this->final_att_mark, 8, 2)+
        round($this->final_quiz_mark, 8, 2)+
        round($this->final_assignment_mark, 8, 2)+
        round($this->final_ct_mark, 8, 2)+
        round($this->final_finalExam_mark, 8, 2)+
        round($this->final_practical_mark, 8, 2)
      ), 8, 2);
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

    public function updateGrade($request){
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
            $tb->user_id = Auth::user()->id;
            $tb->created_at = date('Y-m-d H:i:s');
            $tb->updated_at = date('Y-m-d H:i:s');
            $tbc[] = $tb->attributesToArray();
            $i++;
        }
        return $tbc;
    }

    public function returnRouteWithParameters($route_name){
      return redirect()->route($route_name, [
        'teacher_id' => $this->teacher_id,
        'course_id' => $this->course_id,
        'exam_id' => $this->exam_id,
        'section_id' => $this->section_id,
      ]);
    }
}