<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\SemesterInterface;
use App\Interfaces\SchoolSessionInterface;
use App\Http\Requests\TeacherAssignRequest;
use App\Repositories\AssignedTeacherRepository;

class AssignedTeacherController extends Controller
{
    use SchoolSession;

    protected $semesterRepository;

    /**
    * Create a new Controller instance
    *
    * @param SchoolSessionInterface $schoolSessionRepository
    * @return void
    */
    public function __construct(SemesterInterface $semesterRepository) {
        $this->semesterRepository = $semesterRepository;
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
     * @param Request $request
     * @return Application|Factory|View
     */
    public function getTeacherCourses(Request $request)
    {
        $courses = [];
        $teacherId = $request->query('teacher_id');
        $semesterId = $request->query('semester_id');

        if (is_null($teacherId)) {
            abort(404);
        }

        $currentSchoolSessionId = $this->getSchoolCurrentSession();

        $semesters = $this->semesterRepository->getAll($currentSchoolSessionId);

        $assignedTeacherRepository = new AssignedTeacherRepository();

        if (!is_null($semesterId)) {
            $courses = $assignedTeacherRepository->getTeacherCourses($currentSchoolSessionId, $teacherId, $semesterId);
        }

        return view('courses.teacher')
            ->with([
                    'courses' => $courses,
                    'semesters' => $semesters,
                    'selected_semester_id' => $semesterId
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
     * @param  TeacherAssignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherAssignRequest $request)
    {
        try {
            $assignedTeacherRepository = new AssignedTeacherRepository();
            $assignedTeacherRepository->assign($request->validated());

            return back()->with('status', 'Assigning teacher was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
