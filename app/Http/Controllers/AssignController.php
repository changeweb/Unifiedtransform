<?php

namespace App\Http\Controllers;

use App\Assign;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\User;

class AssignController extends Controller
{
    protected $userService;
    protected $user;

    public function __construct(UserService $userService, User $user){
        $this->userService = $userService;
        $this->user = $user;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showUnassigned()
    {
        $unassigned = \App\StudentInfo::where(
            [
                'session' => now()->year,
                'assigned' => 0
            ]
        )->get();
        return view('finance.unassigned', [
            'unassigned' => $unassigned,
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
        // return $request;
        $channel_id = $request->channel;
        if(isset($request['type'])){
            foreach($request['type'] as $fee_type_id => $toAssign){
                if($toAssign){
                    $fee = \App\Fee::where('fee_channel_id', $channel_id)
                        ->where('fee_type_id', $fee_type_id)
                        ->first();
                    $assign = new \App\Assign;
                    $assign->user_id = $request->user_id;
                    $assign->fee_id = $fee->id;
                    $assign->session = ($request->session)?$request->session:now()->year;
                    $assign->save();
                }
            }
            $student = \App\User::find($request->user_id)->studentInfo;
            $student->assigned = 1;
            $student->channel_id = $request->channel;
            $student->save();
            return redirect('/user/'.\App\User::find($request->user_id)->student_code);
        } else{
            return back()->with('error2', __('Please select a Fee Channel'));
        }

    }

    public function reassign(Request $request)
    {
        // return $request;
        if(isset($request['type'])){
            $firstRows = \App\Assign::where('user_id', $request->user_id)
                ->where('session', $request->session)
                ->delete();
            return $this->store($request);
        } else{
            return back()->with('errors2', __('Please select a Fee Channel'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function show(Assign $assign)
    {
        //
    }

    public function showForm(Request $request)
    {
        // return $request->user; 
        $user = \App\User::find($request->user_id);
        $session = $request->session;
        return view('finance.assignForm', compact('user','session'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function edit(Assign $assign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assign $assign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assign $assign)
    {
        //
    }
}
