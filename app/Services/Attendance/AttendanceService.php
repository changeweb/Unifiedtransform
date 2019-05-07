<?php
namespace App\Services\Attendance;

use App\User;
use App\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceService {
  public $request;

    public function getStudentsBySection($section_id){
        return User::with('section')
                    ->select('id','name','student_code','section_id')
                    ->where('section_id', $section_id)
                    ->student()
                    ->where('active', 1)
                    ->get();
    }

    public function getStudentsWithInfoBySection($section_id){
        return User::with(['section','school','studentInfo'])
              ->where('section_id', $section_id)
              ->student()
              ->where('active', 1)
              ->orderBy('name', 'asc')
              ->paginate(50);
    }

    public function adjustPost($request){
      try{
        for($i=0; $i < count($request->isPresent); $i++){
          $atts[] = [
            'id' => $request->att_id[$i],
            'present' => isset($request->isPresent[$i])?1:0,
            'updated_at' => date('Y-m-d H:i:s'),
          ];
        }
        \Batch::update('attendances',(array) $atts,'id');
        return back()->with('status', 'Updated');
      }catch(\Exception $ex){
        return false;
      }
    }

    public function getTodaysAttendanceBySectionId($section_id){
        return Attendance::where('section_id', $section_id)
                      ->whereDate('created_at', \DB::raw('CURDATE()'))
                      ->orderBy('created_at', 'desc')
                      ->get()
                      ->unique('student_id');
    }

    public function getAllAttendanceBySecAndExam($section_id,$exam_id){
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

    public function getStudent($student_id){
        return User::with('section')
                    ->where('id', $student_id)
                    ->student()
                    ->where('active', 1)
                    ->first();
    }

    public function getAbsentAttendanceByStudentAndExam($student_id, $exId){
        return Attendance::with(['student', 'section'])
                      ->where('student_id', $student_id)
                      ->where('present',0)
                      ->where('exam_id', $exId)
                      ->get();
    }

    public function getAttendanceByStudentAndExam($student_id, $exId){
        return Attendance::with(['student', 'section'])
                      ->where('student_id', $student_id)
                      ->where('exam_id', $exId)
                      ->get();
    }

    public function updateAttendance(){
      $i = 0;
      $at = [];
        foreach ($this->request->attendances as $key => $attendance) {
          $tb = Attendance::find($attendance);
            if(count((array) $tb) === 1 && !isset($this->request["isPresent$i"]) && $tb->present == 1){
              // Attended today's class but escaped
              $tb->updated_at = date('Y-m-d H:i:s');
              $tb->save();
              // Escape record
              $tb2 = new Attendance;
              $tb2->student_id = $this->request->students[$i];
              $tb2->section_id = $this->request->section_id;
              $tb2->exam_id = $this->request->exam_id;
              $tb2->present = 2;
              $tb2->user_id = auth()->user()->id;
              $tb2->created_at = date('Y-m-d H:i:s');
              $tb2->updated_at = date('Y-m-d H:i:s');
              $at[] = $tb2->attributesToArray();
            }
          ++$i;
        }
        return $at;
    }

    public function storeAttendance(){
      $i = 0;
        foreach ($this->request->students as $key => $student) {
          $tb = new Attendance;
          $tb->student_id = $student;
          $tb->section_id = $this->request->section_id;
          $tb->exam_id = $this->request->exam_id;
          $tb->present = isset($this->request["isPresent$i"])?1:0;
          $tb->user_id = auth()->user()->id;
          $tb->created_at = date('Y-m-d H:i:s');
          $tb->updated_at = date('Y-m-d H:i:s');
          $at[] = $tb->attributesToArray();
          ++$i;
        }
        Attendance::insert($at);
    }
}