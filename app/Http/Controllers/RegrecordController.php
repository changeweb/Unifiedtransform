<?php

namespace App\Http\Controllers;

use App\Regrecord;
use Illuminate\Http\Request;

class RegrecordController extends Controller
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
        return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Regrecord  $regrecord
     * @return \Illuminate\Http\Response
     */
    public function show(Regrecord $regrecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regrecord  $regrecord
     * @return \Illuminate\Http\Response
     */
    public function edit(Regrecord $regrecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regrecord  $regrecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regrecord $regrecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regrecord  $regrecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regrecord $regrecord)
    {
        //
    }
}
