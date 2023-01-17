<?php

namespace App\Http\Controllers;

use App\Models\GradeRule;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Repositories\GradeRuleRepository;
use App\Http\Requests\GradeRuleStoreRequest;

class GradeRuleController extends Controller
{
    use SchoolSession;

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gradingSystemId = $request->query('grading_system_id');
        $currentSchoolSessionId = $this->getSchoolCurrentSession();

        $gradeRuleRepository = new GradeRuleRepository();
        $gradeRules = $gradeRuleRepository->getAll($currentSchoolSessionId, $gradingSystemId);

        return view('exams.grade.view-rules', compact('gradeRules'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $grading_system_id = $request->query('grading_system_id');
        $current_school_session_id = $this->getSchoolCurrentSession();
        return view('exams.grade.add-rule', compact('grading_system_id', 'current_school_session_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GradeRuleStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradeRuleStoreRequest $request)
    {
        try {
            $gradeRuleRepository = new GradeRuleRepository();
            $gradeRuleRepository->store($request->validated());

            return back()->with('status', 'Creating grading system rule was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradeRule  $gradeRule
     * @return \Illuminate\Http\Response
     */
    public function show(GradeRule $gradeRule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradeRule  $gradeRule
     * @return \Illuminate\Http\Response
     */
    public function edit(GradeRule $gradeRule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GradeRule  $gradeRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradeRule $gradeRule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $gradeRuleRepository = new GradeRuleRepository();
            $gradeRuleRepository->delete($request->id);

            return back()->with('status', 'Deleting grading system rule was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
