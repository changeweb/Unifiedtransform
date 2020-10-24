<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use App\Http\Requests\Exam\CreateExamRequest;

class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService){
        $this->examService = $examService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = $this->examService->getLatestExamsBySchoolIdWithPagination();
        return view('exams.all',compact('exams'));
    }

    public function indexActive(){
        $exams = $this->examService->getActiveExamsBySchoolId();
        $this->examService->examIds = $exams->pluck('id')->toArray();
        $courses = $this->examService->getCoursesByExamIds();

        return view('exams.active',compact('exams','courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = $this->examService->getClassesBySchoolId();
        $already_assigned_classes = $this->examService->getAlreadyAssignedClasses();
        return view('exams.add',compact('classes','already_assigned_classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExamRequest $request)
    {
        
        $this->examService->request = $request;
        try{
            $this->examService->storeExam();
        } catch (\Exception $e){
            return 'Error: '. $e->getMessage();
        }
        
        //return $this->cindex($course_id, $exam_id, $teacher_id);
        return back()->with('status', __('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->validate([
            'exam_id' => 'required|numeric',
        ]);
        try{
            $this->examService->request = $request;
            $this->examService->updateExam();
        } catch (\Exception $e){
            return 'Error: '. $e->getMessage();
        }
        return back()->with('status', __('Saved'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    private function assignCoursesToExam()
    {
    //   $request->validate([
    //     'course_id' => 'required|numeric',
    //     'exam_id' => 'required|numeric',
    //   ]);
        
        // $tb = Course::find($request->course_id);
        // $tb->exam_id = $request->exam_id;
        // $tb->save();
        // return back()->with('status', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
