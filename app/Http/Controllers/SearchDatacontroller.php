<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchDatacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search');
    }

    public function autocomplete(Request $request)
    {
        $data = \App\User::select('name')
            ->where("name", "LIKE", "%{$request->input('query')}%")
            ->orwhere("lst_name", "%{$request->input('query')}%")
            ->orWhere("given_name", "%{$request->input('query')}%")
            ->get();
        return response()->json($data);
    }

    public function find(Request $request)
    {
        return \App\User::where('name', 'LIKE', "%{$request->get('q')}%")
            ->orWhere('lst_name', 'LIKE', "%{$request->get('q')}%")
            ->orWhere('given_name', 'LIKE', "%{$request->get('q')}%")
            ->orWhere('student_code', 'LIKE', "%{$request->get('q')}%")
            ->where('role', 'student')
            ->orderBy('student_code', 'desc')
            ->get();
        
        // search($request->get('q'), null, true)->get();
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
        //
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
    public function update(Request $request, $id)
    {
        //
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
