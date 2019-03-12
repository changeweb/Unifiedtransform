<?php

namespace App\Http\Controllers;

use App\School as School;
use App\Http\Resources\SchoolResource;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $schools = School::all();
      $classes = \App\Myclass::all();
      $sections = \App\Section::all();
      $teachers = \App\User::where('role', 'teacher.department')->orderBy('name','ASC')->get();
      $departments = \App\Department::where('school_id',\Auth::user()->school_id)->get();
      return view('school.create-school', [
        'schools'=>$schools,
        'classes'=>$classes,
        'sections'=>$sections,
        'teachers'=>$teachers,
        'departments'=>$departments,
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
        'school_name' => 'required|string|max:255',
        'school_medium' => 'required',
        'school_about' => 'required',
        'school_established' => 'required',
      ]);
      $tb = new School;
      $tb->name = $request->school_name;
      $tb->established = $request->school_established;
      $tb->about = $request->school_about;
      $tb->medium = $request->school_medium;
      $tb->code = date("y").substr(number_format(time() * mt_rand(),0,'',''),0,6);
      $tb->theme = 'flatly';
      $tb->save();
      return back()->with('status', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($school_id)
    {
      $admins = \App\User::where('school_id',$school_id)->where('role','admin')->get();
      return view('school.admin-list',['admins'=>$admins]);
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

    public function addDepartment(Request $request){
      $request->validate([
        'department_name' => 'required|string|max:50',
      ]);
      $s = new \App\Department;
      $s->school_id = \Auth::user()->school_id;
      $s->department_name = $request->department_name;
      $s->save();
      return back()->with('status', 'Created');
    }

    public function changeTheme(Request $request){
      $tb = School::find($request->s);
      $tb->theme = $request->school_theme;
      $tb->save();
      return back();
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
      $tb = School::find($id);
      $tb->name = $request->name;
      $tb->about = $request->about;
      //$tb->code = $request->code;
      return ($tb->save())?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // return (School::destroy($id))?response()->json([
      //   'status' => 'success'
      // ]):response()->json([
      //   'status' => 'error'
      // ]);
    }
}
