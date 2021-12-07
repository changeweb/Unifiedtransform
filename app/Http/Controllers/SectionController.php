<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\CourseInterface;
use App\Interfaces\SectionInterface;
use App\Http\Requests\SectionStoreRequest;
use App\Interfaces\SchoolSessionInterface;

class SectionController extends Controller
{
    use SchoolSession;
    
    protected $schoolSectionRepository;
    protected $schoolSessionRepository;
    protected $courseRepository;

    /**
    * Create a new Controller instance
    * 
    * @param SectionInterface $schoolSectionRepository
    * @return void
    */
    public function __construct(SchoolSessionInterface $schoolSessionRepository, SectionInterface $schoolSectionRepository, CourseInterface $courseRepository) {
        $this->schoolSectionRepository = $schoolSectionRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->courseRepository = $courseRepository;
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
     * @param  SectionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionStoreRequest $request)
    {
        try {
            $this->schoolSectionRepository->create($request->validated());

            return back()->with('status', 'Section creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function getByClassId(Request $request) {
        $sections = $this->schoolSectionRepository->getAllByClassId($request->query('class_id', 0));
        $courses = $this->courseRepository->getByClassId($request->query('class_id', 0));

        return response()->json(['sections' => $sections, 'courses' => $courses]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $section_id
     * @return \Illuminate\Http\Response
     */
    public function edit($section_id)
    {
        $current_school_session_id = $this->getSchoolCurrentSession();

        $section = $this->schoolSectionRepository->findById($section_id);

        $data = [
            'current_school_session_id' => $current_school_session_id,
            'section_id'                => $section_id,
            'section'                   => $section,
        ];
        return view('sections.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $this->schoolSectionRepository->update($request);

            return back()->with('status', 'Section edit was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
