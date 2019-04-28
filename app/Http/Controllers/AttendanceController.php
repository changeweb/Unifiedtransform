<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
use App\Http\Resources\AttendanceResource;
use Illuminate\Http\Request;
use App\Http\Traits\GradeTrait;
use App\Services\Attendance\AttendanceService;

class AttendanceController extends Controller
{
    use GradeTrait;
    
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService){
      $this->attendanceService = $attendanceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($section_id, $student_id, $exam_id)
    {
      if($section_id > 0 && \Auth::user()->role != 'student'){
        // View attendances of students of a section
        $students = $this->attendanceService->getStudentsBySection($section_id);
        $attendances = $this->attendanceService->getTodaysAttendanceBySectionId($section_id);
        $attCount = $this->attendanceService->getAllAttendanceBySecAndExam($section_id,$exam_id);

        return view('attendance.attendance', [
          'students' => $students,
          'attendances' => $attendances,
          'attCount' => $attCount,
          'section_id'=>$section_id,
          'exam_id'=>$exam_id
        ]);
      } else {
        // View attendance of a single student by student id
        if(\Auth::user()->role == 'student'){
          // From student view
          $exam = \App\ExamForClass::where('class_id',\Auth::user()->section->class->id)
                  ->where('active', 1)
                  ->first();
        } else {
          // From other users view
          $student = $this->attendanceService->getStudent($student_id);
          $exam = \App\ExamForClass::where('class_id',$student->section->class->id)
                  ->where('active', 1)
                  ->first();
        }
        if($exam)
          $exId = $exam->exam_id;
        else
          $exId = 0;
        $attendances = $this->attendanceService->getAttendanceByStudentAndExam($student_id, $exId);
        return view('attendance.student-attendances',['attendances' => $attendances]);
      }
    }
    /**
     * View for Adjust missing Attendances
     *
     * @return \Illuminate\Http\Response
     */
    public function adjust($student_id){
      $student = $this->attendanceService->getStudent($student_id);
      $exam = \App\ExamForClass::where('class_id',$student->section->class->id)
                  ->where('active', 1)
                  ->first();
      if(count((array) $exam) == 1)
        $exId = $exam->exam_id;
      else
        $exId = 0;
      $attendances = $this->attendanceService->getAbsentAttendanceByStudentAndExam($student_id, $exId);
      return view('attendance.adjust',['attendances'=>$attendances,'student_id'=>$student_id]);
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * Adjust missing Attendances POST request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function adjustPost(Request $request){
      $request->validate([
        'att_id' => 'required|array',
      ]);
      return $this->attendanceService->adjustPost($request);
    }
    /**
      * Add students to a Course before taking attendances
      * @return \Illuminate\Http\Response
    */
    public function addStudentsToCourseBeforeAtt($teacher_id,$course_id,$exam_id,$section_id){
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
       
        $students = $this->attendanceService->getStudentsBySection($section_id);
        $attendances = $this->attendanceService->getTodaysAttendanceBySectionId($section_id);
        $attCount = $this->attendanceService->getAllAttendanceBySecAndExam($section_id,$exam_id);

        return view('attendance.attendance', [
          'students' => $students,
          'attendances' => $attendances,
          'attCount' => $attCount,
          'section_id'=>$section_id,
          'exam_id'=>$exam_id
        ]);
    }
    /**
     * @param  \Illuminate\Http\Request  $request
     * View students of a section to view attendances
     * @return \Illuminate\Http\Response
    */
    public function sectionIndex(Request $request, $section_id){
      $users = $this->attendanceService->getStudentsWithInfoBySection($section_id);

      $request->session()->put('section-attendance', true);

      return view('list.student-list',[
        'users' =>$users,
        'current_page'=>$users->currentPage(),
        'per_page'=>$users->perPage()
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
      $request->validate([
        'students' => 'required|array',
        'attendances' => 'required|array',
        'section_id' => 'required',
        'exam_id' => 'required',
        'update' => 'required',
        'isPresent*' => 'required',
      ]);
      if($request->update == 1){
        $i = 0;
        foreach ($request->attendances as $key => $attendance) {
          // $at[] = [
          //   'id' => $attendance,
          //   'present' => (isset($request["isPresent$i"]))?1:0,
          //   'user_id' => \Auth::user()->id,
          //   //'created_at' => date('Y-m-d H:i:s'),
          //   'updated_at' => date('Y-m-d H:i:s'),
          // ];
          //DB::transaction(function () {
            $tb = Attendance::find($attendance);
            if(count((array) $tb) === 1 && !isset($request["isPresent$i"]) && $tb->present == 1){
              // Attended today's class but escaped
              $tb->updated_at = date('Y-m-d H:i:s');
              $tb->save();
              // Escape record
              $tb2 = new Attendance;
              $tb2->student_id = $request->students[$i];
              $tb2->section_id = $request->section_id;
              $tb2->exam_id = $request->exam_id;
              $tb2->present = 2;
              $tb2->user_id = \Auth::user()->id;
              $tb2->created_at = date('Y-m-d H:i:s');
              $tb2->updated_at = date('Y-m-d H:i:s');
              $at[] = $tb2->attributesToArray();
            }
          //});
          
          $i++;
        }
        if(isset($at))
          if(count($at) > 0)
            Attendance::insert($at);
        // $table = 'attendances';
        // \Batch::update($table,$at,'id');
      } else {
        $i = 0;
        foreach ($request->students as $key => $student) {
          $tb = new Attendance;
          $tb->student_id = $student;
          $tb->section_id = $request->section_id;
          $tb->exam_id = $request->exam_id;
          $tb->present = isset($request["isPresent$i"])?1:0;
          $tb->user_id = \Auth::user()->id;
          $tb->created_at = date('Y-m-d H:i:s');
          $tb->updated_at = date('Y-m-d H:i:s');
          $at[] = $tb->attributesToArray();
          $i++;
        }
        Attendance::insert($at);
      }
      return back()->with('status','Saved');
    }
}
