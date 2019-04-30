<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Resources\GradeResource;
use Illuminate\Http\Request;
use App\Http\Requests\Grade\CalculateMarksRequest;
use App\Http\Traits\GradeTrait;
use App\Services\Grade\GradeService;

class GradeController extends Controller
{
    use GradeTrait;

    protected $gradeService;

    public function __construct(GradeService $gradeService){
      $this->gradeService = $gradeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($student_id)
    {
      if($this->gradeService->isLoggedInUserStudent()){
        $grades = $this->gradeService->getStudentGradesWithInfoCourseTeacherExam(auth()->user()->id);
      } else {
        $grades = $this->gradeService->getStudentGradesWithInfoCourseTeacherExam($student_id);
      }
      if(count($grades) > 0){
        $exams = $this->gradeService->getExamByIdsFromGrades($grades);
        $gradesystems = $this->gradeService->getGradeSystemBySchoolId($grades);
      } else {
        $grades = [];
        $gradesystems = [];
        $exams = [];
      }
      return $this->gradeService->gradeIndexView('grade.student-grade', $grades, $gradesystems, $exams);
    }

    public function tindex($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      
      $grades = $this->gradeService->getGradesByCourseExam($course_id, $exam_id);
      $gradesystems = $this->gradeService->getGradeSystemBySchoolIdGroupByName($grades);

      return $this->gradeService->gradeTeacherIndexView('grade.teacher-grade', $grades, $gradesystems);
    }

    public function cindex($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      $grades = $this->gradeService->getGradesByCourseExam($course_id, $exam_id);
      $gradesystems = $this->gradeService->getGradeSystemBySchoolId($grades);

      return $this->gradeService->gradeCourseIndexView('grade.course-grade', $grades, $gradesystems, $course_id, $exam_id, $teacher_id, $section_id);
    }

    public function allExamsGrade(){
      $classes = \App\Myclass::where('school_id',\Auth::user()->school->id)->get();
      $classIds = $classes->pluck('id')->toArray();
      $sections = \App\Section::whereIn('class_id',$classIds)
                  ->orderBy('section_number')
                  ->get();
      return view('grade.all-exams-grade',[
        'classes'=>$classes,
        'sections'=>$sections
      ]);
    }

    public function gradesOfSection($section_id){
      $examIds = \App\Exam::where('school_id', \Auth::user()->school_id)
                  ->where('active',1)
                  ->pluck('id')
                  ->toArray();
      $courses = \App\Course::where('section_id',$section_id)
                  ->whereIn('exam_id', $examIds)
                  ->pluck('id')
                  ->toArray();
      $grades = Grade::with(['student','course','exam'])
                ->whereIn('course_id', $courses)
                ->get();
      return view('grade.class-result',['grades'=>$grades]);
    }

    public function calculateMarks(CalculateMarksRequest $request){
      $gradeSystem = $this->gradeService->getGradeSystemByname($request->grade_system_name);

      $course = \App\Course::find($request->course_id);

      $grades = $this->gradeService->getGradesByCourseExam($request->course_id, $request->exam_id)->toArray();

      $tbc = $this->gradeService->calculateGpaFromTotalMarks($grades, $course, $gradeSystem);

      $this->gradeService->saveCalculatedGPAFromTotalMarks($tbc);
      
      return $this->gradeService->returnRouteWithParameters('teacher-grade', $request->teacher_id, $request->course_id, $request->exam_id, $request->section_id);
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
      //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new GradeResource(Grade::find($id));
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
    public function update(Request $request)
    {
      $tbc = $this->gradeService->updateGrade($request);
      try{
          if(count($tbc) > 0)
            \Batch::update('grades',$tbc,'id');
        }catch(\Exception $e){
            return "OOps, an error occured";
        }

      return back()->with('status', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Grade::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
