<?php
namespace App\Http\Traits;

use App\Grade as Grade;

trait GradeTrait {
    public function addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id) {
        $countGradeIds = Grade::where('course_id', $course_id)->where('exam_id', $exam_id)->count();
        if($countGradeIds < 1){
            $students = \App\User::where('section_id',$section_id)->where('active',1)->pluck('id')->toArray();

            $grades = Grade::whereIn('student_id',$students)->where('course_id',$course_id)->where('exam_id',$exam_id)->pluck('student_id')->toArray();

            $grade_student_ids = array();

            foreach($grades as $grade){
                array_push($grade_student_ids, $grade->student_id);
            }

            foreach($students as $student_id){
                if(!in_array($student_id,$grades)){
                    $tb = new Grade;
                    $tb->gpa = 0;
                    $tb->marks = 0;
                    $tb->attendance = 0;
                    $tb->quiz1 = 0;
                    $tb->quiz2 = 0;
                    $tb->quiz3 = 0;
                    $tb->quiz4 = 0;
                    $tb->quiz5 = 0;
                    $tb->ct1 = 0;
                    $tb->ct2 = 0;
                    $tb->ct3 = 0;
                    $tb->ct4 = 0;
                    $tb->ct5 = 0;
                    $tb->assignment1 = 0;
                    $tb->assignment2 = 0;
                    $tb->assignment3 = 0;
                    $tb->written = 0;
                    $tb->mcq = 0;
                    $tb->practical = 0;
                    $tb->exam_id = $exam_id;
                    $tb->student_id = $student_id;
                    $tb->teacher_id = $teacher_id;
                    $tb->course_id = $course_id;
                    $tb->created_at = date('Y-m-d H:i:s');
                    $tb->updated_at = date('Y-m-d H:i:s');
                    //$tb->user_id = \Auth::user()->id;
                    $tbc[] = $tb->attributesToArray();
                }
            }
            try{
                if(count($tbc) > 0)
                    Grade::insert($tbc);
                    return;
            }catch(\Exception $e){
                return false;
            }
        }
    }
}