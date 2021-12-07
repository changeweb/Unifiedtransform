<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreFileRequest;
use App\Interfaces\SchoolSessionInterface;
use App\Repositories\AssignmentRepository;

class AssignmentController extends Controller
{
    use SchoolSession;
    protected $schoolSessionRepository;

    /**
    * Create a new Controller instance
    * 
    * @param CourseInterface $schoolCourseRepository
    * @return void
    */
    public function __construct(SchoolSessionInterface $schoolSessionRepository) {
        $this->schoolSessionRepository = $schoolSessionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCourseAssignments(Request $request)
    {
        $course_id = $request->query('course_id', 0);
        $current_school_session_id = $this->getSchoolCurrentSession();
        $assignmentRepository = new AssignmentRepository();
        $assignments = $assignmentRepository->getAssignments($current_school_session_id, $course_id);
        $data = [
            'assignments'   => $assignments,
        ];
        return view('assignments.index', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();
        $data = [
            'current_school_session_id' => $current_school_session_id,
            'class_id'  => $request->query('class_id', 0),
            'section_id'  => $request->query('section_id', 0),
            'course_id'  => $request->query('course_id', 0),
        ];
        return view('assignments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $validatedRequest = $request->validated();
        $validatedRequest['class_id'] = $request->class_id;
        $validatedRequest['section_id'] = $request->section_id;
        $validatedRequest['course_id'] = $request->course_id;
        $validatedRequest['semester_id'] = $request->semester_id;
        $validatedRequest['assignment_name'] = $request->assignment_name;
        $validatedRequest['session_id'] = $this->getSchoolCurrentSession();

        try {
            $assignmentRepository = new AssignmentRepository();
            $assignmentRepository->store($validatedRequest);

            return back()->with('status', 'Creating assignment was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
