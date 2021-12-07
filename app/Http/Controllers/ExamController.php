<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamStoreRequest;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\SemesterInterface;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\SchoolSessionInterface;
use App\Repositories\AssignedTeacherRepository;
use App\Repositories\ExamRepository;

class ExamController extends Controller
{
    use SchoolSession;

    protected $schoolClassRepository;
    protected $semesterRepository;
    protected $schoolSessionRepository;

    public function __construct(SchoolSessionInterface $schoolSessionRepository, SchoolClassInterface $schoolClassRepository, SemesterInterface $semesterRepository)
    {
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->semesterRepository = $semesterRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $class_id = $request->query('class_id', 0);
        $semester_id = $request->query('semester_id', 0);

        $current_school_session_id = $this->getSchoolCurrentSession();

        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);

        $examRepository = new ExamRepository();

        $exams = $examRepository->getAll($current_school_session_id, $semester_id, $class_id);

        $assignedTeacherRepository = new AssignedTeacherRepository();

        $teacher_id = (auth()->user()->role == "teacher")?auth()->user()->id : 0;

        $teacherCourses = $assignedTeacherRepository->getTeacherCourses($current_school_session_id, $teacher_id, $semester_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'semesters'                 => $semesters,
            'classes'                   => $school_classes,
            'exams'                     => $exams,
            'teacher_courses'           => $teacherCourses,
        ];

        return view('exams.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $semesters = $this->semesterRepository->getAll($current_school_session_id);

        if(auth()->user()->role == "teacher") {
            $teacher_id = auth()->user()->id;
            $assigned_classes = $this->schoolClassRepository->getAllBySessionAndTeacher($current_school_session_id, $teacher_id);

            $school_classes = [];
            $i = 0;

            foreach($assigned_classes as $assigned_class) {
                $school_classes[$i] = $assigned_class->schoolClass;
                $i++;
            }
        } else {
            $school_classes = $this->schoolClassRepository->getAllBySession($current_school_session_id);
        }

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'semesters'                 => $semesters,
            'classes'                   => $school_classes,
        ];

        return view('exams.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExamStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamStoreRequest $request)
    {
        try {
            $examRepository = new ExamRepository();
            $examRepository->create($request->validated());

            return back()->with('status', 'Exam creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $examRepository = new ExamRepository();
            $examRepository->delete($request->exam_id);

            return back()->with('status', 'Exam deletion was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
