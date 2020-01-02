<?php

namespace App\Http\Controllers;

use App\Section as Section;
use App\Http\Resources\SectionResource;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $school = \Auth::user()->school;
        $classes = \App\Myclass::bySchool(\Auth::user()->school->id)
                    ->get();
        $classeIds = \App\Myclass::bySchool(\Auth::user()->school->id)
                        ->pluck('id')
                        ->toArray();
        $sections = \App\Section::whereIn('class_id',$classeIds)
                    ->orderBy('class_id')
                    ->get();
        $exams = \App\ExamForClass::whereIn('class_id',$classeIds)
                    ->where('active', 1)
                    ->groupBy('class_id')
                    ->get();
        // $departments = Department::bySchool(\Auth::user()->school_id)->get();
        // $teachers = User::select('departments.*', 'users.*')
        //     ->join('departments', 'departments.id', '=', 'users.department_id')
        //     ->where('role', 'teacher')
        //     ->orderBy('name', 'ASC')
        //     ->where('active', 1)
        //     ->get();

        return view('school.sections',[
            'classes'=>$classes,
            'sections'=>$sections,
            'exams'=>$exams,
            'school'=>$school,
            // 'departments'=>$departments,
            // 'teachers'=>$tecahers,

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
        'section_number' => 'required',
        'room_number' => 'required|numeric',
        'class_id' => 'required|numeric',
      ]);
      $tb = new Section;
      $tb->section_number = $request->section_number;
      $tb->room_number = $request->room_number;
      $tb->class_id = $request->class_id;
      $tb->save();
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
        return new SectionResource(Section::find($id));
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
    public function update(Request $request, $id)
    {
      $tb = Section::find($id);
      $tb->section_number = $request->section_number;
      $tb->room_number = $request->room_number;
      $tb->class_id = $request->class_id;
      return ($tb->save())?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tct_update(Request $request, $id)
    {
        $tb = Section::find($id);
        $tb->section_number = $request->section_number;
        $tb->room_number = $request->room_number;
        $tb->class_id = $request->class_number;
        $tb->active = $request->section_active;
        $tb->save();
        return redirect('school/sections?course=1');
    
    //   return ($tb->save())?response()->json([
    //     'status' => 'success'
    //   ]):response()->json([
    //     'status' => 'error'
    //   ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return (Section::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
