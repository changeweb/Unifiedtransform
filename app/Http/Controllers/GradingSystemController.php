<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradingSystem;
use App\Traits\SchoolSession;
use App\Interfaces\SemesterInterface;
use App\Interfaces\SchoolClassInterface;
use App\Http\Requests\GradingSystemStoreRequest;
use App\Repositories\GradingSystemRepository;

class GradingSystemController extends Controller
{
    use SchoolSession;

    protected $schoolClassRepository;

    protected $semesterRepository;

    public function __construct(
        SchoolClassInterface $schoolClassRepository,
        SemesterInterface $semesterRepository)
    {
        $this->schoolClassRepository = $schoolClassRepository;
        $this->semesterRepository = $semesterRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gradingSystemRepository = new GradingSystemRepository();
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $gradingSystems = $gradingSystemRepository->getAll($currentSchoolSessionId);

        $data = [
            'gradingSystems'            => $gradingSystems,
            'current_school_session_id' => $currentSchoolSessionId,
        ];

        return view('exams.grade.view', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $schoolClasses = $this->schoolClassRepository->getAllBySession($currentSchoolSessionId);
        $semesters = $this->semesterRepository->getAll($currentSchoolSessionId);

        $data = [
            'current_school_session_id' => $currentSchoolSessionId,
            'school_classes'            => $schoolClasses,
            'semesters'                 => $semesters,
        ];

        return view('exams.grade.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GradingSystemStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradingSystemStoreRequest $request)
    {
        try {
            $gradingSystemRepository = new GradingSystemRepository();
            $gradingSystemRepository->store($request->validated());

            return back()->with('status', 'Creating grading system was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Http\Response
     */
    public function show(GradingSystem $gradingSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(GradingSystem $gradingSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradingSystem $gradingSystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradingSystem $gradingSystem)
    {
        //
    }
}
