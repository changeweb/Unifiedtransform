<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Myclass;
use App\Section;
use App\Department;
use Illuminate\Http\Request;
use App\Http\Requests\SchoolRequest;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $schools = School::orderBy('created_at', 'desc')->paginate();

      return view('schools.index', compact('schools'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchoolRequest $request)
    {
        School::create([
            'name'        => $request->name,
            'established' => $request->established,
            'about'       => $request->about,
            'medium'      => $request->medium,
            'code'        => date("y").substr(number_format(time() * mt_rand(), 0, '', ''), 0, 6),
            'theme'       => 'flatly'
        ]);

        return redirect()->route('schools.index')->with('status', __('Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($school_id)
    {
      $admins = User::bySchool($school_id)->where('role','admin')->get();
      return view('school.admin-list',compact('admins'));
    }

    public function edit(School $school) {
        return view('schools.edit', compact('school'));
    }

    public function update(Request $request, School $school) {
        $school->name = $request->name;
        $school->about = $request->about;
        $school->save();

        return redirect()->route('schools.index');
    }

    public function addDepartment(Request $request){
      $request->validate([
        'department_name' => 'required|string|max:50',
      ]);
      $s = new Department;
      $s->school_id = \Auth::user()->school_id;
      $s->department_name = $request->department_name;
      $s->save();
      return back()->with('status', __('Created'));
    }

    public function changeTheme(Request $request){
      $tb = School::find($request->s);
      $tb->theme = $request->school_theme;
      $tb->save();
      return back();
    }

	public function setIgnoreSessions(Request $request){
		$request->session()->put('ignoreSessions', $request->ignoreSessions);
		return response()->json([
		  'data' => [
			'success' => "Setting saved"
		  ]
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
