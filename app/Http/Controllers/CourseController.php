<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Http\Requests\Course\SaveConfigurationRequest;
use App\Http\Traits\GradeTrait;
use App\Services\Course\CourseService;

class CourseController extends Controller
{
    use GradeTrait;
    protected $courseService;

    public function __construct(CourseService $courseService){
      $this->courseService = $courseService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacher_id, $section_id){
      if($this->courseService->isCourseOfTeacher($teacher_id)) {
        $courses = $this->courseService->getCoursesByTeacher($teacher_id);
        $exams = $this->courseService->getExamsBySchoolId();
        $view = 'course.teacher-course';

      } else if($this->courseService->isCourseOfStudentOfASection($section_id)) {
        $courses = $this->courseService->getCoursesBySection($section_id);
        $view = 'course.class-course';
        $exams = [];

      } else if($this->courseService->isCourseOfASection($section_id)) {
        $courses = $this->courseService->getCoursesBySection($section_id);
        $exams = $this->courseService->getExamsBySchoolId();
        $view = 'course.class-course';
      } else {
        return redirect('home');
      }
      return view($view,compact('courses','exams'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function course($teacher_id,$course_id,$exam_id,$section_id)
    {
      $this->addStudentsToCourse($teacher_id,$course_id,$exam_id,$section_id);
      $students = $this->courseService->getStudentsFromGradeByCourseAndExam($course_id, $exam_id);

      return view('course.students', compact('students','teacher_id','section_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $this->courseService->addCourse($request);
      } catch (\Exception $ex){
        return __('Could not add course.');
      }
      return back()->with('status', __('Created'));
    }

    /**
     * @param SaveConfigurationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveConfiguration(SaveConfigurationRequest $request){
      try{
        $this->courseService->saveConfiguration($request);
      } catch (\Exception $ex){
        return __('Could not save configuration.');
      }
      return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return new CourseResource(Course::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $course = Course::find($id);
      return view('course.edit', ['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateNameAndTime(Request $request, $id)
    {
      $request->validate([
        'course_name' => 'required|string',
        'course_time' => 'required|string',
      ]);
      $this->courseService->updateCourseInfo($id, $request);
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
      return (Course::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
