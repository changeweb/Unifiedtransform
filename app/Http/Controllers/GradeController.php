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

      $this->gradeService->grades = $grades;
      $this->gradeService->gradesystems = $gradesystems;
      $this->gradeService->exams = $exams;

      return $this->gradeService->gradeIndexView('grade.student-grade');
    }

    public function tindex($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      
      $grades = $this->gradeService->getGradesByCourseExam($course_id, $exam_id);
      $gradesystems = $this->gradeService->getGradeSystemBySchoolIdGroupByName($grades);

      $this->gradeService->grades = $grades;
      $this->gradeService->gradesystems = $gradesystems;

      return $this->gradeService->gradeTeacherIndexView('grade.teacher-grade');
    }

    public function cindex($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      $grades = $this->gradeService->getGradesByCourseExam($course_id, $exam_id);
      $gradesystems = $this->gradeService->getGradeSystemBySchoolId($grades);

      $this->gradeService->grades = $grades;
      $this->gradeService->gradesystems = $gradesystems;
      $this->gradeService->course_id = $course_id;
      $this->gradeService->exam_id = $exam_id;
      $this->gradeService->teacher_id = $teacher_id;
      $this->gradeService->section_id = $section_id;

      return $this->gradeService->gradeCourseIndexView('grade.course-grade');
    }

    public function allExamsGrade(){
      $classes = $this->gradeService->getClassesBySchoolId();
      $classIds = $classes->pluck('id')->toArray();
      $sections = $this->gradeService->getSectionsByClassIds($classIds);
      return view('grade.all-exams-grade',compact('classes',
        'sections'));
    }

    public function gradesOfSection($section_id){
      $examIds = $this->gradeService->getActiveExamIds()->toArray();
      $courses = $this->gradeService->getCourseBySectionIdExamIds($section_id, $examIds);
      $grades = $this->gradeService->getGradesByCourseId($courses);

      return view('grade.class-result',compact('grades'));
    }

    public function calculateMarks(CalculateMarksRequest $request){
      $gradeSystem = $this->gradeService->getGradeSystemByname($request->grade_system_name);

      $this->gradeService->course_id = $request->course_id;
      $course = $this->gradeService->getCourseByCourseId();

      $grades = $this->gradeService->getGradesByCourseExam($request->course_id, $request->exam_id)->toArray();

      $tbc = $this->gradeService->calculateGpaFromTotalMarks($grades, $course, $gradeSystem);

      $this->gradeService->saveCalculatedGPAFromTotalMarks($tbc);

      $this->gradeService->course_id = $request->course_id;
      $this->gradeService->exam_id = $request->exam_id;
      $this->gradeService->teacher_id = $request->teacher_id;
      $this->gradeService->section_id = $request->section_id;
      
      return $this->gradeService->returnRouteWithParameters('teacher-grade');
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
            \Batch::update('grades', (array) $tbc,'id');
        }catch(\Exception $e){
            return __("Ops, an error occured");
        }

      return back()->with('status', __('Saved'));
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
