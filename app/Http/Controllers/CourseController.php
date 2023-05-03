<?php

namespace App\Http\Controllers;

use App\Interfaces\PromotionRepository;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\CourseInterface;
use App\Http\Requests\CourseStoreRequest;

class CourseController extends Controller
{
    use SchoolSession;

    private $schoolCourseRepository;

    private $promotionRepository;


    /**
     * Create a new Controller instance
     * @param CourseInterface $schoolCourseRepository
     * @return void
     */
    public function __construct(CourseInterface     $schoolCourseRepository,
                                PromotionRepository $promotionRepository,
    ) {
        $this->schoolCourseRepository = $schoolCourseRepository;
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param CourseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        try {
            $this->schoolCourseRepository->create($request->validated());
            return back()->with('status', 'Course creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentCourses(int $studentId)
    {
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $classInfo = $this->promotionRepository->getPromotionInfoById($currentSchoolSessionId, $studentId);
        $courses = $this->schoolCourseRepository->getByClassId($classInfo->class_id);
        return view('courses.student')
            ->with([
                'class_info' => $classInfo,
                'courses' => $courses,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $course_id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $courseId)
    {
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $course = $this->schoolCourseRepository->findById($courseId);
        return view('courses.edit')
            ->with([
                'current_school_session_id' => $currentSchoolSessionId,
                'course' => $course,
                'course_id' => $courseId,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $this->schoolCourseRepository->update($request);
            return back()->with('status', 'Course update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
