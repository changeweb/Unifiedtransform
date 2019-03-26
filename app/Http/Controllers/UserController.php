<?php

namespace App\Http\Controllers;

use App\User as User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($school_code, $student_code, $teacher_code)
    {
      session()->forget('section-attendance');
      if(!empty($school_code) && $student_code == 1){// For student
        $users = User::with(['section.class','school','studentInfo'])
                      ->where('code', $school_code)
                      ->where('role', 'student')
                      ->orderBy('name', 'asc')
                      ->paginate(50);
        return view('list.student-list',[
                                          'users' =>$users,
                                          'current_page'=>$users->currentPage(),
                                          'per_page'=>$users->perPage()
                                        ]);
      } else if(!empty($school_code) && $teacher_code == 1){// For teacher
        $users = User::with(['section','school'])
                      ->where('code', $school_code)
                      ->where('role', 'teacher')
                      ->orderBy('name', 'asc')
                      ->paginate(50);
        return view('list.teacher-list',[
                                          'users' => $users,
                                          'current_page'=>$users->currentPage(),
                                          'per_page'=>$users->perPage()
                                        ]);
      }
    }

    public function indexOther($school_code, $role){
      if($role == 'accountant'){
        $users = User::with('school')
                      ->where('code', $school_code)
                      ->where('role', 'accountant')
                      ->orderBy('name', 'asc')
                      ->paginate(50);
        return view('accounts.accountant-list',[
                                                'users' => $users,
                                                'current_page'=>$users->currentPage(),
                                                'per_page'=>$users->perPage()
                                              ]);
      } else if($role == 'librarian') {
        $users = User::with('school')
                      ->where('code', $school_code)
                      ->where('role', 'librarian')
                      ->orderBy('name', 'asc')
                      ->paginate(50);
        return view('library.librarian-list',[
                                              'users' => $users,
                                              'current_page'=>$users->currentPage(),
                                              'per_page'=>$users->perPage()
                                            ]);
      } else {
        return view('home');
      }
    }

    public function redirectToRegisterStudent(){
      $classes = \App\Myclass::where('school_id',\Auth::user()->school->id)->pluck('id');
      $sections = \App\Section::with('class')->whereIn('class_id',$classes)->get();
      session([
        'register_role' => 'student',
        'register_sections' => $sections
        ]);
      return redirect()->route('register');
    }

    public function sectionStudents($section_id){
      $students = User::with('school')
                    ->where('role', 'student')
                    ->where('section_id', $section_id)
                    ->where('active',1)
                    ->orderBy('name', 'asc')
                    ->get();
      return view('profile.section-students',['students' => $students]);
    }

    public function promoteSectionStudents($section_id){
      if($section_id > 0){
        $students = User::with('section','studentInfo')
                        ->where('section_id', $section_id)
                        ->get();
        $classes = \App\Myclass::with('sections')
                                ->where('school_id', \Auth::user()->school_id)
                                ->get();
      } else {
        $students = [];
        $classes = [];
      }
      return view('school.promote-students',[
                                              'students'=>$students,
                                              'classes'=>$classes,
                                              'section_id'=>$section_id
                                            ]);
    }

    public function promoteSectionStudentsPost(Request $request){
      if($request->section_id > 0){
        $students = User::where('section_id', $request->section_id)->get();
        $i = 0;
        foreach($students as $student){
          // $sectionTb = User::find($student->id);
          // $sectionTb->section_id = $request->to_section[$i];
          // $sectionTb->save();
          $st[] = [
            'id' => $student->id,
            'section_id' => $request->to_section[$i]
          ];
          $st2[] = [
            'student_id' => $student->id,
            'session' => $request->to_session[$i]
          ];
          // $sessionTb = \App\StudentInfo::where('student_id',$student->id)->first();
          // if(count($sessionTb) > 0){
          //   $sessionTb->session = $request->to_session[$i];
          //   $sessionTb->save();
          // }
          $i++;
        }
        \DB::transaction(function () use ($st, $st2){
          $table1 = 'users';
          \Batch::update($table1,$st,'id');
          $table2 = 'student_infos';
          \Batch::update($table2,$st2,'student_id');
        });
        return back()->with('status', 'Saved');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_code)
    {
      //$user = User::with('section')->where('code', Auth::user()->code)->where('student_code', $student_code)->first();
      $user = User::with('section','studentInfo')
                  ->where('student_code', $user_code)
                  ->first();
      return view('profile.user', ['user' => $user]);
    }

    public function changePasswordGet(){
      return view('profile.change-password');
    }

    public function changePasswordPost(Request $request){
      $request->validate([
        'old_password' => 'required|min:6',
        'new_password' => 'required|min:6',
      ]);

      if (Hash::check($request->old_password, \Auth::user()->password)) {
        $request->user()->fill([
          'password' => Hash::make($request->new_password)
        ])->save();
        return back()->with('status', 'Saved');
      }
      return back()->with('error-status', 'Passwords do not match.');
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
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'section' => 'required|numeric',
        'gender' => 'required|string',
        'blood_group' => 'required|string',
        'nationality' => 'required|string',
        'father_name' => 'required|string',
        'mother_name' => 'required|string',
        'phone_number' => 'required|string|unique:users',
        'address' => 'required|string',
        'session' => 'required',
        'version' => 'required',
        'birthday' => 'required',
        'religion' => 'required|string',
      ]);
      if(!empty($request->email)){
        $request->validate([
          'email' => 'email|max:255|unique:users',
        ]);
      }
      \DB::transaction(function () use ($request) {
        $tb = new User;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email))?$request->email:'';
        $tb->password = bcrypt($request->password);
        $tb->role = 'student';
        $tb->active = 1;
        $tb->school_id = \Auth::user()->school_id;
        $tb->code = \Auth::user()->code;
        $tb->student_code = \Auth::user()->school_id.date("y").substr(number_format(time() * mt_rand(),0,'',''),0,5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality))?$request->nationality:'';
        $tb->phone_number = $request->phone_number;
        $tb->address = (!empty($request->address))?$request->address:'';
        $tb->about = (!empty($request->about))?$request->about:'';
        $tb->pic_path = (!empty($request->pic_path))?$request->pic_path:'';
        $tb->verified = 1;
        $tb->section_id = $request->section;
        $tb->save();
        $info = new \App\StudentInfo;
        $info->student_id = $tb->id;
        $info->session = $request->session;
        $info->version = $request->version;
        $info->group = (!empty($request->group))?$request->group:'';
        $info->birthday = $request->birthday;
        $info->religion = $request->religion;
        $info->father_name = $request->father_name;
        $info->father_phone_number = (!empty($request->father_phone_number))?$request->father_phone_number:'';
        $info->father_national_id = (!empty($request->father_national_id))?$request->father_national_id:'';
        $info->father_occupation = (!empty($request->father_occupation))?$request->father_occupation:'';
        $info->father_designation = (!empty($request->father_designation))?$request->father_designation:'';
        $info->father_annual_income = (!empty($request->father_annual_income))?$request->father_annual_income:'';
        $info->mother_name = $request->mother_name;
        $info->mother_phone_number = (!empty($request->mother_phone_number))?$request->mother_phone_number:'';
        $info->mother_national_id = (!empty($request->mother_national_id))?$request->mother_national_id:'';
        $info->mother_occupation = (!empty($request->mother_occupation))?$request->mother_occupation:'';
        $info->mother_designation = (!empty($request->mother_designation))?$request->mother_designation:'';
        $info->mother_annual_income = (!empty($request->mother_annual_income))?$request->mother_annual_income:'';
        $info->user_id = \Auth::user()->id;
        $info->save();
      });
    
      return back()->with('status', 'Saved');
    }

    public function storeAdmin(Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'gender' => 'required',
        'blood_group' => 'required',
        //'nationality' => 'required',
        'phone_number' => 'required|unique:users',
        'email' => 'email|max:255|unique:users',
      ]);
      // if(!empty($request->email)){
      //   $request->validate([
      //     'email' => 'email|max:255|unique:users',
      //   ]);
      // }
      $tb = new User;
      $tb->name = $request->name;
      $tb->email = $request->email;
      $tb->password = bcrypt($request->password);
      $tb->role = 'admin';
      $tb->active = 1;
      $tb->school_id = session('register_school_id');
      $tb->code = session('register_school_code');
      $tb->student_code = session('register_school_id').date("y").substr(number_format(time() * mt_rand(),0,'',''),0,5);
      $tb->gender = $request->gender;
      $tb->blood_group = $request->blood_group;
      $tb->nationality = (!empty($request->nationality))?$request->nationality:'';
      $tb->phone_number = $request->phone_number;
      $tb->pic_path = (!empty($request->pic_path))?$request->pic_path:'';
      $tb->verified = 1;
      $tb->save();
      return back()->with('status', 'Saved');
    }

     public function storeTeacher(Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'gender' => 'required',
        'blood_group' => 'required',
        'department_id' => 'required|numeric',
        'phone_number' => 'required|unique:users',
      ]);
      if(!empty($request->email)){
        $request->validate([
          'email' => 'email|max:255|unique:users',
        ]);
      }
      $tb = new User;
      $tb->name = $request->name;
      $tb->email = (!empty($request->email))?$request->email:'';
      $tb->password = bcrypt($request->password);
      $tb->role = 'teacher';
      $tb->active = 1;
      $tb->school_id = \Auth::user()->school_id;
      $tb->code = \Auth::user()->code;
      $tb->student_code = \Auth::user()->school_id.date("y").substr(number_format(time() * mt_rand(),0,'',''),0,5);
      $tb->gender = $request->gender;
      $tb->blood_group = $request->blood_group;
      $tb->nationality = (!empty($request->nationality))?$request->nationality:'';
      $tb->phone_number = $request->phone_number;
      $tb->pic_path = (!empty($request->pic_path))?$request->pic_path:'';
      $tb->verified = 1;
      $tb->department_id = $request->department_id;
      $tb->section_id = ($request->class_teacher_section_id != 0)?$request->class_teacher_section_id:0;
      $tb->save();
      return back()->with('status', 'Saved');
    }

     public function storeAccountant(Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'gender' => 'required',
        'blood_group' => 'required',
        //'nationality' => 'required',
        'phone_number' => 'required|unique:users',
      ]);
      if(!empty($request->email)){
        $request->validate([
          'email' => 'email|max:255|unique:users',
        ]);
      }
      $tb = new User;
      $tb->name = $request->name;
      $tb->email = (!empty($request->email))?$request->email:'';
      $tb->password = bcrypt($request->password);
      $tb->role = 'accountant';
      $tb->active = 1;
      $tb->school_id = \Auth::user()->school_id;
      $tb->code = \Auth::user()->code;
      $tb->student_code = \Auth::user()->school_id.date("y").substr(number_format(time() * mt_rand(),0,'',''),0,5);
      $tb->gender = $request->gender;
      $tb->blood_group = $request->blood_group;
      $tb->nationality = (!empty($request->nationality))?$request->nationality:'';
      $tb->phone_number = $request->phone_number;
      $tb->pic_path = (!empty($request->pic_path))?$request->pic_path:'';
      $tb->verified = 1;
      $tb->save();
      return back()->with('status', 'Saved');
    }

     public function storeLibrarian(Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'gender' => 'required',
        'blood_group' => 'required',
        //'nationality' => 'required',
        'phone_number' => 'required|unique:users',
      ]);
      if(!empty($request->email)){
        $request->validate([
          'email' => 'email|max:255|unique:users',
        ]);
      }
      $tb = new User;
      $tb->name = $request->name;
      $tb->email = (!empty($request->email))?$request->email:'';
      $tb->password = bcrypt($request->password);
      $tb->role = 'librarian';
      $tb->active = 1;
      $tb->school_id = \Auth::user()->school_id;
      $tb->code = \Auth::user()->code;
      $tb->student_code = \Auth::user()->school_id.date("y").substr(number_format(time() * mt_rand(),0,'',''),0,5);
      $tb->gender = $request->gender;
      $tb->blood_group = $request->blood_group;
      $tb->nationality = (!empty($request->nationality))?$request->nationality:'';
      $tb->phone_number = $request->phone_number;
      $tb->pic_path = (!empty($request->pic_path))?$request->pic_path:'';
      $tb->verified = 1;
      $tb->save();
      return back()->with('status', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new UserResource(User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);
      $classes = \App\Myclass::where('school_id',\Auth::user()->school_id)
                            ->pluck('id')
                            ->toArray();
      $sections = \App\Section::whereIn('class_id',$classes)->get();
      $departments = \App\Department::where('school_id',\Auth::user()->school_id)->get();
      return view('profile.edit',[
                                  'user'=>$user,
                                  'sections'=>$sections,
                                  'departments'=>$departments
                                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $this->validate($request,[
        'user_id' => 'required|numeric',
        'email' => [
          'required',
          'email',
          'max:255',
          Rule::unique('users')->ignore($request->user_id),
        ],
        'name' => 'required|string|max:255',
        'phone_number' => [
          'required',
          'string',
          Rule::unique('users')->ignore($request->user_id),
        ],
      ]);
      if ($request->user_role == 'teacher'){
        $request->validate([
          'department_id' => 'required|numeric',
        ]);
      }
      
      \DB::transaction(function () use ($request){
        $tb = User::find($request->user_id);
        $tb->name = $request->name;
        $tb->email = (!empty($request->email))?$request->email:'';
        $tb->nationality = (!empty($request->nationality))?$request->nationality:'';
        $tb->phone_number = $request->phone_number;
        $tb->address = (!empty($request->address))?$request->address:'';
        $tb->about = (!empty($request->about))?$request->about:'';
        $tb->pic_path = (!empty($request->pic_path))?$request->pic_path:'';
        if ($request->user_role == 'teacher'){
          $tb->department_id = $request->department_id;
          $tb->section_id = $request->class_teacher_section_id;
        }
        if($tb->save()){
          if($request->user_role == 'student'){
            // $request->validate([
            //   'session' => 'required',
            //   'version' => 'required',
            //   'birthday' => 'required',
            //   'religion' => 'required',
            //   'father_name' => 'required',
            //   'mother_name' => 'required',
            // ]);
            $info = \App\StudentInfo::firstOrCreate(['student_id'=>$request->user_id]);
            $info->student_id = $tb->id;
            $info->session = (!empty($request->session))?$request->session:'';
            $info->version = (!empty($request->version))?$request->version:'';
            $info->group = (!empty($request->group))?$request->group:'';
            $info->birthday = (!empty($request->birthday))?$request->birthday:'';
            $info->religion = (!empty($request->religion))?$request->religion:'';
            $info->father_name = (!empty($request->father_name))?$request->father_name:'';
            $info->father_phone_number = (!empty($request->father_phone_number))?$request->father_phone_number:'';
            $info->father_national_id = (!empty($request->father_national_id))?$request->father_national_id:'';
            $info->father_occupation = (!empty($request->father_occupation))?$request->father_occupation:'';
            $info->father_designation = (!empty($request->father_designation))?$request->father_designation:'';
            $info->father_annual_income = (!empty($request->father_annual_income))?$request->father_annual_income:'';
            $info->mother_name = (!empty($request->mother_name))?$request->mother_name:'';
            $info->mother_phone_number = (!empty($request->mother_phone_number))?$request->mother_phone_number:'';
            $info->mother_national_id = (!empty($request->mother_national_id))?$request->mother_national_id:'';
            $info->mother_occupation = (!empty($request->mother_occupation))?$request->mother_occupation:'';
            $info->mother_designation = (!empty($request->mother_designation))?$request->mother_designation:'';
            $info->mother_annual_income = (!empty($request->mother_annual_income))?$request->mother_annual_income:'';
            $info->user_id = \Auth::user()->id;
            $info->save();
          }
        }
      });
      
      return back()->with('status', 'Saved');
    }

    /**
     * Activate admin
    */
    public function activateAdmin($id){
      $admin = User::find($id);
      if($admin->active !== 0)
        $admin->active = 0;
      else
        $admin->active = 1;
      $admin->save();
      return back()->with('status', 'Saved');
    }

    /**
     * Deactivate admin
    */
    public function deactivateAdmin($id){
      $admin = User::find($id);
      if($admin->active !== 1)
        $admin->active = 1;
      else
        $admin->active = 0;
      $admin->save();
      return back()->with('status', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // return (User::destroy($id))?response()->json([
      //   'status' => 'success'
      // ]):response()->json([
      //   'status' => 'error'
      // ]);
    }
}
