<?php

namespace App\Http\Controllers;

use App\Http\BaseControllers;
use App\Models\Semester;
use App\Interfaces\SemesterInterface;
use App\Http\Requests\SemesterStoreRequest;

class SemesterController extends BaseControllers
{
    protected $semesterRepository;

    public function __construct(SemesterInterface $semesterRepository) {
        $this->semesterRepository = $semesterRepository;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  SemesterStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemesterStoreRequest $request)
    {
        try {
            $this->semesterRepository->create($request->validated());

            return back()->with('status', 'Semester creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
}
