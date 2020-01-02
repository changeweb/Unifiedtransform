<?php

namespace App\Http\Controllers;

use App\Inactive;
use App\User;
use Illuminate\Http\Request;

class InactiveController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'notes' => 'required'
            ]);

        // CREATE NEW INACTIVE RECORD
        $tb = new Inactive;
        $tb->session = date('Y');
        $tb->user_id = $request->user_id;
        $tb->type = $request->type;
        $tb->notes = (!empty($request->notes))?$request->notes:'';
        $tb->save();
        // print($tb);

        // UPDATE 'active' FIELD IN USERS TABLE
        $tb2 = User::find($request->user_id);
        $tb2->active = 0;
        $tb2->save();
        
        return redirect("/user/$tb2->student_code");
        // return redirect()->action('App\Http\Controllers\UserController@show', [$tb2->sco]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inactive  $inactive
     * @return \Illuminate\Http\Response
     */
    public function show(Inactive $inactive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inactive  $inactive
     * @return \Illuminate\Http\Response
     */
    public function edit(Inactive $inactive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inactive  $inactive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    public function tct_update(Request $request)
    {
        // print($request);
        $request->validate([
            'notes' => 'required'
        ]);
        // UPDATE INACTIVE RECORD
        $tb = Inactive::find($request->inactive_id);
        $tb->session = $request->session;
        $tb->type = $request->type;
        $tb->notes = (!empty($request->notes))?$request->notes:'';
        $tb->save();
        
        $tb2 = User::find($request->user_id);
        return redirect("/user/$tb2->student_code");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inactive  $inactive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inactive $inactive)
    {
        //
    }
}
