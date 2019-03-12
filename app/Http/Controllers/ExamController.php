<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = \App\Exam::where('school_id', \Auth::user()->school_id)
                    ->latest()
                    ->paginate(100);
        return view('exams.all',['exams'=>$exams]);
    }

    public function indexActive(){
        $examIds = \App\Exam::where('school_id', \Auth::user()->school_id)
                    ->where('active',1)
                    ->pluck('id')
                    ->toArray();
        $exams = \App\Exam::where('school_id', \Auth::user()->school_id)
                    ->where('active',1)
                    ->get();
        $courses = \App\Course::with('class','teacher')
                    ->whereIn('exam_id', $examIds)
                    ->orderBy('class_id')
                    ->get();
        return view('exams.active',[
            'exams'=>$exams,
            'courses'=>$courses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = \App\Myclass::where('school_id',\Auth::user()->school->id)->get();
        return view('exams.add',['classes'=>$classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'exam_name' => 'required|string',
            'term' => 'required|string',
            'exam_start_date' => 'required|string',
            'exam_end_date' => 'required|string',
        ]);

        \DB::transaction(function () use ($request) {
            $exam = new \App\Exam;
            $exam->exam_name = $request->exam_name;
            $exam->active = 1;
            $exam->term = $request->term;
            $exam->start_date = $request->exam_start_date;
            $exam->end_date = $request->exam_end_date;
            $exam->school_id = \Auth::user()->school_id;
            $exam->user_id = \Auth::user()->id;
            $exam->save();
            $i = 0;
            $tc = count($request->classes);
        
            // Assign Exam ID to Classes in Course Table
            \App\Course::whereIn('class_id',$request->classes)->update([
                'exam_id' => $exam->id
            ]);

            while($i < $tc){
                $examForClass = new \App\ExamForClass;
                $examForClass->exam_id = $exam->id;
                $examForClass->class_id = $request->classes[$i];
                $efc[] = $examForClass->attributesToArray();
                $i++;
            }
            if(count($efc) > 0)
                \App\ExamForClass::insert($efc);
        }, 5);
        
        //return $this->cindex($course_id, $exam_id, $teacher_id);
        return back()->with('status', 'Created');
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
        $tb = \App\Exam::find($request->exam_id);
        $tb->notice_published = isset($request->notice_published)?1:0;
        $tb->result_published = isset($request->result_published)?1:0;
        $tb->active = (isset($request->active))?1:0;
        $tb->save();
        return back()->with('status', 'Saved');
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
        
        $tb = Course::find($request->course_id);
        $tb->exam_id = $request->exam_id;
        $tb->save();
        return back()->with('status', 'Saved');
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
