<?php
namespace App\Http\Controllers\Attendance;

use App\User;
use App\Attendance;
use Illuminate\Support\Facades\Auth;

class HandleAttendance {

    public static function getStudentsBySection($section_id){
        return User::with('section')
                    ->select('id','name','student_code','section_id')
                    ->where('section_id', $section_id)
                    ->where('role', 'student')
                    ->where('active', 1)
                    ->get();
    }

    public static function getStudentsWithInfoBySection($section_id){
        return User::with(['section','school','studentInfo'])
              ->where('section_id', $section_id)
              ->where('role', 'student')
              ->where('active', 1)
              ->orderBy('name', 'asc')
              ->paginate(50);
    }

    public static function adjustPost($request){
      try{
        for($i=0; $i < count($request->isPresent); $i++){
          $atts[] = [
            'id' => $request->att_id[$i],
            'present' => isset($request->isPresent[$i])?1:0,
            'updated_at' => date('Y-m-d H:i:s'),
          ];
        }
        \Batch::update('attendances',$atts,'id');
        return back()->with('status', 'Updated');
      }catch(\Exception $ex){
        return false;
      }
    }

    public static function getTodaysAttendanceBySectionId($section_id){
        return Attendance::where('section_id', $section_id)
                      ->whereDate('created_at', \DB::raw('CURDATE()'))
                      ->orderBy('created_at', 'desc')
                      ->get()
                      ->unique('student_id');
    }

    public static function getAllAttendanceBySecAndExam($section_id,$exam_id){
        return \DB::table('attendances')
                    ->select('student_id', \DB::raw('
                      COUNT(CASE WHEN present=1 THEN present END) AS totalPresent,
                      COUNT(CASE WHEN present=0 THEN present END) AS totalAbsent,
                      COUNT(CASE WHEN present=2 THEN present END) AS totalEscaped'
                    ))
                    ->where('section_id', $section_id)
                    ->where('exam_id', $exam_id)
                    ->groupBy('student_id')
                    ->get();
    }

    public static function getStudent($student_id){
        return User::with('section')
                    ->where('id', $student_id)
                    ->where('role', 'student')
                    ->where('active', 1)
                    ->first();
    }

    public static function getAbsentAttendanceByStudentAndExam($student_id, $exId){
        return Attendance::with(['student', 'section'])
                      ->where('student_id', $student_id)
                      ->where('present',0)
                      ->where('exam_id', $exId)
                      ->get();
    }

    public static function getAttendanceByStudentAndExam($student_id, $exId){
        return Attendance::with(['student', 'section'])
                      ->where('student_id', $student_id)
                      ->where('exam_id', $exId)
                      ->get();
    }
}