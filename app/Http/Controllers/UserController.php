<?php

namespace App\Http\Controllers;

use App\Department;
use App\Myclass;
use App\Section;
use App\StudentInfo;
use App\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\CreateAdminRequest;
use App\Http\Requests\User\CreateTeacherRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\CreateLibrarianRequest;
use App\Http\Requests\User\CreateAccountantRequest;
use Mavinoo\LaravelBatch\Batch;
use App\Events\UserRegistered;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $school_code
     * @param $student_code
     * @param $teacher_code
     * @return \Illuminate\Http\Response
     */
    public function index($school_code, $student_code, $teacher_code)
    {
        session()->forget('section-attendance');
        if (!empty($school_code) && $student_code == 1) {// For student
            $users = User::with(['section.class', 'school', 'studentInfo'])
                ->where('code', $school_code)
                ->where('role', 'student')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);

            return view('list.student-list', [
                'users' => $users,
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
            ]);
        } elseif (!empty($school_code) && $teacher_code == 1) {// For teacher
            $users = User::with(['section', 'school'])
                ->where('code', $school_code)
                ->where('role', 'teacher')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);

            return view('list.teacher-list', [
                'users' => $users,
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
            ]);
        }
    }

    /**
     * @param $school_code
     * @param $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexOther($school_code, $role)
    {
        if ($role == 'accountant') {
            $users = User::with('school')
                ->where('code', $school_code)
                ->where('role', 'accountant')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);

            return view('accounts.accountant-list', [
                'users' => $users,
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
            ]);
        } elseif ($role == 'librarian') {
            $users = User::with('school')
                ->where('code', $school_code)
                ->where('role', 'librarian')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);

            return view('library.librarian-list', [
                'users' => $users,
                'current_page' => $users->currentPage(),
                'per_page' => $users->perPage(),
            ]);
        } else {
            return view('home');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToRegisterStudent()
    {
        $classes = Myclass::query()
            ->where('school_id', Auth::user()->school->id)
            ->pluck('id');

        $sections = Section::with('class')
            ->whereIn('class_id', $classes)
            ->get();

        session([
            'register_role' => 'student',
            'register_sections' => $sections,
        ]);

        return redirect()->route('register');
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sectionStudents($section_id)
    {
        $students = User::with('school')
            ->where('role', 'student')
            ->where('section_id', $section_id)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('profile.section-students', ['students' => $students]);
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promoteSectionStudents($section_id)
    {
        if ($section_id > 0) {
            $students = User::with('section', 'studentInfo')
                ->where('section_id', $section_id)
                ->where('active', 1)
                ->get();
            $classes = Myclass::with('sections')
                ->where('school_id', Auth::user()->school_id)
                ->get();
        } else {
            $students = [];
            $classes = [];
        }

        return view('school.promote-students', [
            'students' => $students,
            'classes' => $classes,
            'section_id' => $section_id,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promoteSectionStudentsPost(Request $request)
    {
        if ($request->section_id > 0) {
            $students = User::where('section_id', $request->section_id)
                ->where('active', 1)
                ->get();
            $i = 0;
            foreach ($students as $student) {
                $st[] = [
                    'id' => $student->id,
                    'section_id' => $request->to_section[$i],
                    'active' => isset($request["left_school$i"])?0:1,
                ];

                $st2[] = [
                    'student_id' => $student->id,
                    'session' => $request->to_session[$i],
                ];

                ++$i;
            }
            DB::transaction(function () use ($st, $st2) {
                $table1 = 'users';
                \Batch::update($table1, $st, 'id');
                $table2 = 'student_infos';
                \Batch::update($table2, $st2, 'student_id');
            });

            return back()->with('status', 'Saved');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $user_code
     * @return \Illuminate\Http\Response
     */
    public function create($user_code)
    {
        //$user = User::with('section')->where('code', Auth::user()->code)->where('student_code', $student_code)->first();
        $user = User::with('section', 'studentInfo')
              ->where('student_code', $user_code)
              ->where('active', 1)
              ->first();

        return view('profile.user', ['user' => $user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePasswordGet()
    {
        return view('profile.change-password');
    }

    /**
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePasswordPost(ChangePasswordRequest $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $request->user()->fill([
              'password' => Hash::make($request->new_password),
            ])->save();

            return back()->with('status', 'Saved');
        }

        return back()->with('error-status', 'Passwords do not match.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $tb = new User();
            $tb->name = $request->name;
            $tb->email = (!empty($request->email)) ? $request->email : '';
            $tb->password = bcrypt($request->password);
            $tb->role = 'student';
            $tb->active = 1;
            $tb->school_id = Auth::user()->school_id;
            $tb->code = Auth::user()->code;
            $tb->student_code = Auth::user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
            $tb->gender = $request->gender;
            $tb->blood_group = $request->blood_group;
            $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
            $tb->phone_number = $request->phone_number;
            $tb->address = (!empty($request->address)) ? $request->address : '';
            $tb->about = (!empty($request->about)) ? $request->about : '';
            $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
            $tb->verified = 1;
            $tb->section_id = $request->section;
            $tb->save();

            $info = new StudentInfo();
            $info->student_id = $tb->id;
            $info->session = $request->session;
            $info->version = $request->version;
            $info->group = (!empty($request->group)) ? $request->group : '';
            $info->birthday = $request->birthday;
            $info->religion = $request->religion;
            $info->father_name = $request->father_name;
            $info->father_phone_number = (!empty($request->father_phone_number)) ? $request->father_phone_number : '';
            $info->father_national_id = (!empty($request->father_national_id)) ? $request->father_national_id : '';
            $info->father_occupation = (!empty($request->father_occupation)) ? $request->father_occupation : '';
            $info->father_designation = (!empty($request->father_designation)) ? $request->father_designation : '';
            $info->father_annual_income = (!empty($request->father_annual_income)) ? $request->father_annual_income : '';
            $info->mother_name = $request->mother_name;
            $info->mother_phone_number = (!empty($request->mother_phone_number)) ? $request->mother_phone_number : '';
            $info->mother_national_id = (!empty($request->mother_national_id)) ? $request->mother_national_id : '';
            $info->mother_occupation = (!empty($request->mother_occupation)) ? $request->mother_occupation : '';
            $info->mother_designation = (!empty($request->mother_designation)) ? $request->mother_designation : '';
            $info->mother_annual_income = (!empty($request->mother_annual_income)) ? $request->mother_annual_income : '';
            $info->user_id = Auth::user()->id;
            $info->save();
        });

        return back()->with('status', 'Saved');
    }

    /**
     * @param CreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(CreateAdminRequest $request)
    {
        $password = $request->password;
        $tb = new User();
        $tb->name = $request->name;
        $tb->email = $request->email;
        $tb->password = bcrypt($request->password);
        $tb->role = 'admin';
        $tb->active = 1;
        $tb->school_id = session('register_school_id');
        $tb->code = session('register_school_code');
        $tb->student_code = session('register_school_id').date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->save();

        // Fire event to send welcome email
        // event(new userRegistered($userObject, $plain_password)); // $plain_password(optional)
        event(new UserRegistered($tb, $password));

        return back()->with('status', 'Saved');
    }

    /**
     * @param CreateTeacherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTeacher(CreateTeacherRequest $request)
    {
        $tb = new User();
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = 'teacher';
        $tb->active = 1;
        $tb->school_id = Auth::user()->school_id;
        $tb->code = Auth::user()->code;
        $tb->student_code = Auth::user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->department_id = $request->department_id;
        $tb->section_id = ($request->class_teacher_section_id != 0) ? $request->class_teacher_section_id : 0;
        $tb->save();

        return back()->with('status', 'Saved');
    }

    /**
     * @param CreateAccountantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAccountant(CreateAccountantRequest $request)
    {
        $tb = new User();
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = 'accountant';
        $tb->active = 1;
        $tb->school_id = Auth::user()->school_id;
        $tb->code = Auth::user()->code;
        $tb->student_code = Auth::user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->save();

        return back()->with('status', 'Saved');
    }

    /**
     * @param CreateLibrarianRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLibrarian(CreateLibrarianRequest $request)
    {
        $tb = new User();
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = 'librarian';
        $tb->active = 1;
        $tb->school_id = Auth::user()->school_id;
        $tb->code = Auth::user()->code;
        $tb->student_code = Auth::user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->save();

        return back()->with('status', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show($id)
    {
        return new UserResource(User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $classes = Myclass::query()
            ->where('school_id', Auth::user()->school_id)
            ->pluck('id')
            ->toArray();

        $sections = Section::query()
            ->whereIn('class_id', $classes)
            ->get();

        $departments = Department::query()
            ->where('school_id', Auth::user()->school_id)
            ->get();

        return view('profile.edit', [
            'user' => $user,
            'sections' => $sections,
            'departments' => $departments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        DB::transaction(function () use ($request) {
            $tb = User::find($request->user_id);
            $tb->name = $request->name;
            $tb->email = (!empty($request->email)) ? $request->email : '';
            $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
            $tb->phone_number = $request->phone_number;
            $tb->address = (!empty($request->address)) ? $request->address : '';
            $tb->about = (!empty($request->about)) ? $request->about : '';
            $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
            if ($request->user_role == 'teacher') {
                $tb->department_id = $request->department_id;
                $tb->section_id = $request->class_teacher_section_id;
            }
            if ($tb->save()) {
                if ($request->user_role == 'student') {
                    // $request->validate([
                    //   'session' => 'required',
                    //   'version' => 'required',
                    //   'birthday' => 'required',
                    //   'religion' => 'required',
                    //   'father_name' => 'required',
                    //   'mother_name' => 'required',
                    // ]);
                    $info = StudentInfo::firstOrCreate(['student_id' => $request->user_id]);
                    $info->student_id = $tb->id;
                    $info->session = (!empty($request->session)) ? $request->session : '';
                    $info->version = (!empty($request->version)) ? $request->version : '';
                    $info->group = (!empty($request->group)) ? $request->group : '';
                    $info->birthday = (!empty($request->birthday)) ? $request->birthday : '';
                    $info->religion = (!empty($request->religion)) ? $request->religion : '';
                    $info->father_name = (!empty($request->father_name)) ? $request->father_name : '';
                    $info->father_phone_number = (!empty($request->father_phone_number)) ? $request->father_phone_number : '';
                    $info->father_national_id = (!empty($request->father_national_id)) ? $request->father_national_id : '';
                    $info->father_occupation = (!empty($request->father_occupation)) ? $request->father_occupation : '';
                    $info->father_designation = (!empty($request->father_designation)) ? $request->father_designation : '';
                    $info->father_annual_income = (!empty($request->father_annual_income)) ? $request->father_annual_income : '';
                    $info->mother_name = (!empty($request->mother_name)) ? $request->mother_name : '';
                    $info->mother_phone_number = (!empty($request->mother_phone_number)) ? $request->mother_phone_number : '';
                    $info->mother_national_id = (!empty($request->mother_national_id)) ? $request->mother_national_id : '';
                    $info->mother_occupation = (!empty($request->mother_occupation)) ? $request->mother_occupation : '';
                    $info->mother_designation = (!empty($request->mother_designation)) ? $request->mother_designation : '';
                    $info->mother_annual_income = (!empty($request->mother_annual_income)) ? $request->mother_annual_income : '';
                    $info->user_id = \Auth::user()->id;
                    $info->save();
                }
            }
        });

        return back()->with('status', 'Saved');
    }

    /**
     * Activate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateAdmin($id)
    {
        $admin = User::find($id);

        if ($admin->active !== 0) {
            $admin->active = 0;
        } else {
            $admin->active = 1;
        }

        $admin->save();

        return back()->with('status', 'Saved');
    }

    /**
     * Deactivate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateAdmin($id)
    {
       $admin = User::find($id);

        if ($admin->active !== 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }

        $admin->save();

        return back()->with('status', 'Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return void
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
