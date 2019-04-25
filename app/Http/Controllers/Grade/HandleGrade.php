<?php
namespace App\Http\Controllers\Grade;

use App\Grade;
use Illuminate\Support\Facades\Auth;

class HandleGrade {

    public static function calculateMarks($course, $grade){
        $quizCount = $course->quiz_count;
        $assignmentCount = $course->assignment_count;
        $ctCount = $course->ct_count;
        $attPerc = $course->attendance_percent;
        $assignPerc = $course->assignment_percent;
        $quizPerc = $course->quiz_percent;
        $ctPerc = $course->ct_percent;
        $finalExamPerc = $course->final_exam_percent;
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

        return $totalMarks;
    }

    public static function updateGrade($request){
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
}