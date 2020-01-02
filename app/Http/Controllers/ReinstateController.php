<?php

namespace App\Http\Controllers;

use App\Reinstate;
use App\User;
use Illuminate\Http\Request;

class ReinstateController extends Controller
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

    // CREATE NEW REINSTATE RECORD
    $tb = new Reinstate;
    $tb->session = date('Y');
    $tb->user_id = $request->user_id;
    $tb->inactive_id = $request->inactive_id;
    $tb->notes = (!empty($request->notes))?$request->notes:'';
    $tb->approved = $request->approval;
    $tb->save();
    print($tb);

    $tb2 = User::find($request->user_id);
    // UPDATE 'active' FIELD IN USERS TABLE
    if($request->approval){
        $tb2->active = 1;
        $tb2->save();
    }
    
    // return redirect()->to('user/'.User::find($request->user_id)->school_code );
    return redirect("/user/$tb2->student_code");

    }

    public function approval(Request $request){
        $tb = Reinstate::find($request->reinstate_id);
        $tb->approved = 1;
        $tb->save();

        $tb2 = User::find($request->user_id);
        $tb2->active = 1;
        $tb2->save();

        return redirect("/user/$tb2->student_code");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reinstate  $reinstate
     * @return \Illuminate\Http\Response
     */
    public function show(Reinstate $reinstate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reinstate  $reinstate
     * @return \Illuminate\Http\Response
     */
    public function edit(Reinstate $reinstate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reinstate  $reinstate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reinstate $reinstate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reinstate  $reinstate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reinstate $reinstate)
    {
        //
    }
}
