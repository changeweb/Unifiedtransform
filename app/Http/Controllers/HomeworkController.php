<?php

namespace App\Http\Controllers;

use App\Homework as Homework;
use App\Http\Resources\HomeworkResource;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($teacher_id, $section_id)
    {
      if($section_id > 0){
        return  HomeworkResource::collection(Homework::where('section_id', $section_id)->get());
      } else if($teacher_id > 0){
          return HomeworkResource::collection(Homework::where('teacher_id', $teacher_id)->get());
      } else {
        return response()->json([
          'Invalid section_id: '.$section_id,
          'Invalid Teacher_id: '.$teacher_id,
          404]);
      }
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
      $tb = new Homework;
      $tb->file_path = $request->file_path;
      $tb->description = $request->description;
      $tb->teacher_id = $request->teacher_id;
      $tb->section_id = $request->section_id;

      return($tb->save())?response()->json([
        'status' => 'success'
        ]):response()->json([
          'status' => 'error'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return HomeworkResource(Homework::find($id));
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
      $tb = Homework::find($id);
      $tb->description = $request->description;
      $tb->teacher_id = $request->teacher_id;
      $tb->section_id = $request->section_id;
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
      return (Homework::destroy($id))?response()->json([
        'status' => 'success'
      ]):response()->json([
        'status' => 'error'
      ]);
    }
}
