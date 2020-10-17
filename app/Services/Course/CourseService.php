<?php
namespace App\Services\Course;

use App\User;
use App\Course;
use App\Grade;
use App\Exam;
use Illuminate\Support\Facades\Auth;

class CourseService {
    public function isCourseOfTeacher($teacher_id){
        return auth()->user()->role != 'student' && $teacher_id > 0;
    }

    public function isCourseOfStudentOfASection($section_id){
        return auth()->user()->role == 'student'
                && $section_id == auth()->user()->section_id
                && $section_id > 0;
    }

    public function isCourseOfASection($section_id){
        return auth()->user()->role != 'student' && $section_id > 0;
    }

    public function getCoursesByTeacher($teacher_id){
        return Course::with(['section', 'teacher','exam'])
                        ->where('teacher_id', $teacher_id)
                        ->get();
    }

    public function getExamsBySchoolId(){
        return Exam::where('school_id', auth()->user()->school_id)
                        ->where('active',1)
                        ->get();
    }

    public function updateCourseInfo($id, $request){
        $tb = Course::find($id);
        $tb->course_name = $request->course_name;
        $tb->course_time = $request->course_time;
        $tb->save();
    }

    public function getCoursesBySection($section_id){
        return Course::with(['section', 'teacher'])
                        ->where('section_id', $section_id)
                        ->get();
    }

    public function getStudentsFromGradeByCourseAndExam($course_id, $exam_id){
      return Grade::with('student')
                  ->where('course_id', $course_id)
                  ->where('exam_id',$exam_id)
                  ->get();
    }

    public function addCourse($request){
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

    public function saveConfiguration($request){
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