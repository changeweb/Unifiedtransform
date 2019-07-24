<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
use App\Http\Resources\AttendanceResource;
use Illuminate\Http\Request;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
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
    public function store(StoreAttendanceRequest $request)
    {
      $this->attendanceService->request = $request;
      if($request->update == 1){
        $at = $this->attendanceService->updateAttendance();
        if(isset($at))
          if(count($at) > 0)
            Attendance::insert($at);
      } else {
        $this->attendanceService->storeAttendance();
      }
      return back()->with('status',__('Saved'));
    }
}
