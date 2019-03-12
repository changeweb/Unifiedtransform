<?php

namespace App\Http\Controllers;

use App\Attendance as Attendance;
use App\User as User;
use App\Http\Resources\AttendanceResource;
use Illuminate\Http\Request;
use App\Http\Traits\GradeTrait;

class AttendanceController extends Controller
{
    use GradeTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($section_id, $student_id, $exam_id)
    {
      if($section_id > 0 && \Auth::user()->role != 'student'){
        $students = User::with('section')
                    ->select('id','name','student_code','section_id')
                    ->where('section_id', $section_id)
                    ->where('role', 'student')
                    ->get();
        $attendances = Attendance::where('section_id', $section_id)
                      ->whereDate('created_at', \DB::raw('CURDATE()'))
                      ->orderBy('created_at', 'desc')
                      ->get()
                      ->unique('student_id');
        $attCount = \DB::table('attendances')
                    ->select('student_id', \DB::raw('
                      COUNT(CASE WHEN present=1 THEN present END) AS totalPresent,
                      COUNT(CASE WHEN present=0 THEN present END) AS totalAbsent,
                      COUNT(CASE WHEN present=2 THEN present END) AS totalEscaped'
                    ))
                    ->where('section_id', $section_id)
                    ->where('exam_id', $exam_id)
                    ->groupBy('student_id')
                    ->get();

        return view('attendance.attendance', [
          'students' => $students,
          'attendances' => $attendances,
          'attCount' => $attCount,
          'section_id'=>$section_id,
          'exam_id'=>$exam_id
        ]);
      } else {
        if(\Auth::user()->role == 'student'){
          $exam = \App\ExamForClass::where('class_id',\Auth::user()->section->class->id)->first();
          $attendances = Attendance::with(['student', 'section'])
                      ->where('student_id', $student_id)
                      ->get();
        } else {
          $student = User::with('section')->where('id',$student_id)->first();
          $exam = \App\ExamForClass::where('class_id',$student->section->class->id)->first();
          
          if(count($exam) == 1)
            $exId = $exam->exam_id;
          else
            $exId = 0;
          $attendances = Attendance::with(['student', 'section'])
                      ->where('student_id', $student_id)
                      ->where('exam_id', $exId)
                      ->get();
        }
        return view('attendance.student-attendances',['attendances' => $attendances]);
      }
    }

    public function adjust($student_id){
      $student = User::with('section')->where('id',$student_id)->first();
      $exam = \App\ExamForClass::where('class_id',$student->section->class->id)->first();
      if(count($exam) == 1)
        $exId = $exam->exam_id;
      else
        $exId = 0;
      $attendances = Attendance::with(['student', 'section'])
                      ->where('student_id', $student_id)
                      ->where('present',0)
                      ->where('exam_id', $exId)
                      ->get();
      return view('attendance.adjust',['attendances'=>$attendances,'student_id'=>$student_id]);
    }

    public function adjustPost(Request $request){
      $request->validate([
        'att_id' => 'required|array',
      ]);
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

    public function addStudentsToCourseBeforeAtt($teacher_id,$course_id,$exam_id,$section_id){
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
       
        $students = User::with('section')
                    ->select('id','name','student_code','section_id')
                    ->where('section_id', $section_id)
                    ->where('role', 'student')
                    ->get();
        $attendances = Attendance::where('section_id', $section_id)
                      ->whereDate('created_at', \DB::raw('CURDATE()'))
                      ->orderBy('created_at', 'desc')
                      ->get()
                      ->unique('student_id');
        $attCount = \DB::table('attendances')
                    ->select('student_id', \DB::raw('
                      COUNT(CASE WHEN present=1 THEN present END) AS totalPresent,
                      COUNT(CASE WHEN present=0 THEN present END) AS totalAbsent,
                      COUNT(CASE WHEN present=2 THEN present END) AS totalEscaped'
                    ))
                    ->where('section_id', $section_id)
                    ->where('exam_id', $exam_id)
                    ->groupBy('student_id')
                    ->get();

        return view('attendance.attendance', [
          'students' => $students,
          'attendances' => $attendances,
          'attCount' => $attCount,
          'section_id'=>$section_id,
          'exam_id'=>$exam_id
        ]);
    }

    public function sectionIndex(Request $request, $section_id){
      $users = User::with(['section','school','studentInfo'])
              ->where('section_id', $section_id)
              ->where('role', 'student')
              ->orderBy('name', 'asc')
              ->paginate(50);

      $request->session()->put('section-attendance', true);

      return view('list.student-list',[
        'users' =>$users,
        'current_page'=>$users->currentPage(),
        'per_page'=>$users->perPage()
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
      $request->validate([
        'students' => 'required|array',
        'attendances' => 'required|array',
        'section_id' => 'required',
        'exam_id' => 'required',
        'update' => 'required',
        'isPresent*' => 'required',
      ]);
      dd($request);
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
            if(count($tb) === 1 && !isset($request["isPresent$i"]) && $tb->present == 1){
              $tb->updated_at = date('Y-m-d H:i:s');
              $tb->save();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AttendanceResource(Attendance::find($id));
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
    public function update(Request $request, $id)
    {
        $tb = Attendance::find($id);
        $tb->student_id = $request->student_id;
        $tb->section_id = $request->section_id;

        return ($tb->save())?response()->json([
          'status' => 'success'
        ]):response()->json([
          'status' => 'error'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Attendance::destroy($id))?response()->json([
          'status' => 'success'
        ]):response()->json([
          'status' => 'error'
        ]);

    }
}
