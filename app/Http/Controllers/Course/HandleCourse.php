<?php
namespace App\Http\Controllers\Course;

use App\User;
use App\Course;
use App\Grade;
use Illuminate\Support\Facades\Auth;

class HandleCourse {
    public static function getCoursesByTeacher($teacher_id){
        return Course::with(['section', 'teacher','exam'])
                        ->where('teacher_id', $teacher_id)
                        ->get();
    }

    public static function getCoursesBySection($section_id){
        return Course::with(['section', 'teacher'])
                        ->where('section_id', $section_id)
                        ->get();
    }

    public static function getStudentsFromGradeByCourseAndExam($course_id, $exam_id){
      return Grade::with('student')
                  ->where('course_id', $course_id)
                  ->where('exam_id',$exam_id)
                  ->get();
    }

    public static function addCourse($request){
        $tb = new Course;
        $tb->course_name = $request->course_name;
        $tb->class_id = $request->class_id;
        $tb->course_type = $request->course_type;
        $tb->course_time = $request->course_time;
        $tb->section_id = $request->section_id;
        $tb->teacher_id = $request->teacher_id;
        $tb->grade_system_name = '';
        $tb->quiz_count = 0;
        $tb->assignment_count = 0;
        $tb->ct_count = 0;
        $tb->quiz_percent = 0;
        $tb->attendance_percent = 0;
        $tb->assignment_percent = 0;
        $tb->ct_percent = 0;
        $tb->final_exam_percent = 0;
        $tb->practical_percent = 0;
        $tb->att_fullmark = 0;
        $tb->quiz_fullmark = 0;
        $tb->a_fullmark = 0;
        $tb->ct_fullmark = 0;
        $tb->final_fullmark = 0;
        $tb->practical_fullmark = 0;
        $tb->exam_id = 0;
        $tb->school_id = auth()->user()->school_id;
        $tb->user_id = auth()->user()->id; // who is creating
        // $tb->quiz_percent = $request->quiz_percent;
        // $tb->test_percent = $request->test_percent;
        // $tb->assignment_percent = $request->assignment_percent;
        // $tb->class_work_percent = $request->class_work_percent;
        // $tb->final_exam_percent = $request->final_exam_percent;
        $tb->save();
    }

    public static function saveConfiguration($request){
        $tb = Course::find($request->id);
        $tb->grade_system_name = $request->grade_system_name;
        $tb->quiz_count = $request->quiz_count;
        $tb->assignment_count = $request->assignment_count;
        $tb->ct_count = $request->ct_count;
        $tb->quiz_percent = $request->quiz_percent;
        $tb->attendance_percent = $request->attendance_percent;
        $tb->assignment_percent = $request->assignment_percent;
        $tb->ct_percent = $request->ct_percent;
        $tb->final_exam_percent = $request->final_exam_percent;
        $tb->practical_percent = $request->practical_percent;
        $tb->att_fullmark = $request->att_fullmark;
        $tb->quiz_fullmark = $request->quiz_fullmark;
        $tb->a_fullmark = $request->a_fullmark;
        $tb->ct_fullmark = $request->ct_fullmark;
        $tb->final_fullmark = $request->final_fullmark;
        $tb->practical_fullmark = $request->practical_fullmark;
        $tb->save();
    }
}