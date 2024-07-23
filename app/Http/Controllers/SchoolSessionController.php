<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolSessionStoreRequest;
use App\Http\Requests\SchoolSessionBrowseRequest;

class SchoolSessionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  SchoolSessionStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolSessionStoreRequest $request)
    {
        try {
            $this->schoolSessionRepository->create($request->validated());

            return back()->with('status', 'Session creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }

    }

    /**
     * Save the selected school session as current session for
     * browsing.
     *
     * @param  SchoolSessionBrowseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function browse(SchoolSessionBrowseRequest $request)
    {
        try {
            $this->schoolSessionRepository->browse($request->validated());

            return back()->with('status', 'Browsing session set was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }

    }
}
