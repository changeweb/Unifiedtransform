<?php

namespace App\Http\Controllers;

use App\Department;
use App\Myclass;
use App\Section;
use App\StudentInfo;
use App\User;
use App\House;
use App\Regrecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\TCTCreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;   
use App\Http\Requests\User\CreateAdminRequest;
use App\Http\Requests\User\CreateTeacherRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\ImpersonateUserRequest;
use App\Http\Requests\User\CreateLibrarianRequest;
use App\Http\Requests\User\CreateAccountantRequest;
use Mavinoo\LaravelBatch\Batch;
use App\Events\UserRegistered;
use App\Events\StudentInfoUpdateRequested;
use App\Events\TCTStudentInfoUpdateRequested;
use Illuminate\Support\Facades\Log;
use App\Services\User\UserService;
/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
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
     * @param $school_code
     * @param $student_code
     * @param $teacher_code
     * @return \Illuminate\Http\Response
     */
    public function index($school_code, $student_code, $teacher_code){
        session()->forget('section-attendance');
        
        if($this->userService->isListOfStudents($school_code, $student_code))
            return $this->userService->indexView('list.student-list', $this->userService->getStudents());
        else if($this->userService->isListOfTeachers($school_code, $teacher_code))
            return $this->userService->indexView('list.teacher-list',$this->userService->getTeachers());
        else
            return view('home');
    }

    public function tct_index($school_code, $student_code, $teacher_code){
        session()->forget('section-attendance');
        
        if($this->userService->isListOfStudents($school_code, $student_code))
            return $this->userService->indexTCTView('list.tct-student-list', $this->userService->getTCTStudents(), 'registered');
        else
            return view('home');
    }

    public function tct_list_archive(){
        return $this->userService->indexTCTView('list.tct-student-list', $this->userService->getTCTArchive(), 'archived');
    }

    /**
     * @param $school_code
     * @param $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexOther($school_code, $role){
        if($this->userService->isAccountant($role))
            return $this->userService->indexOtherView('accounts.accountant-list', $this->userService->getAccountants());
        else if($this->userService->isLibrarian($role))
            return $this->userService->indexOtherView('library.librarian-list', $this->userService->getLibrarians());
        else
            return view('home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToRegisterStudent()
    {
        $classes = Myclass::query()
            ->bySchool(\Auth::user()->school->id)
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
     * @return \Illuminate\Http\RedirectResponse
     */
    // Update controller to redirect to TCT version of Registration Form
    public function redirectToRegisterTCTStudent()
    {
        $classes = Myclass::with('sections')->where('school_id',\Auth::user()->school->id)->get();
        $classes_id = Myclass::with('sections')->where('school_id',\Auth::user()->school->id)->pluck('id');
        $sections = Section::with('class')
        ->whereIn('class_id',$classes_id)
        ->get();
        $form_nums = $this->userService->getFormNumbersArray($sections);
        $houses = House::all();

        session([
            'register_role' => 'student',
            'register_role_action' => 'tct_student',
            'register_sections' => $sections,
            'register_forms' => $classes,
            'register_class' => $classes_id,
            'register_house' => $houses,
            'register_numbers' => $form_nums,
            'tct_id' => $this->userService->getTCTID(),
        ]);
        return redirect()->route('tct_register');
    }

    public function showTCTRegistrationForm()
    {
        return view('auth.tct_register');
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sectionStudents($section_id)
    {
        $students = $this->userService->getSectionStudentsWithSchool($section_id);

        return view('profile.section-students', compact('students'));
    }

    public function sectionTCTStudents($section_id)
    {
        $students = $this->userService->getTCTSectionStudentsWithSchool($section_id);
        $section = Section::find($section_id);
        $max_form = DB::table('student_infos')->where(['form_id'=> $section_id, 'session'=>date('Y')])->max('form_num');
        $max_loop = ($max_form == 0)? 1 : $max_form;

        return view('profile.section-tct-students', compact('students', 'section', 'max_loop'));
    }

    public function houseTCTStudents($house_id)
    {
        $students = \App\StudentInfo::where(
            [
                'session' => now()->year,
                'house_id'=> $house_id
            ])
        ->orderBy('group', 'asc')
        ->get();
        $house = House::find($house_id);

        return view('profile.house-tct-students', compact('students', 'house'));
    }

    /**
     * @param $section_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function promoteSectionStudents(Request $request, $section_id)
    {
        if($this->userService->hasSectionId($section_id))
            return $this->userService->promoteSectionStudentsView(
                $this->userService->getSectionStudentsWithStudentInfo($request, $section_id),
                Myclass::with('sections')->bySchool(\Auth::user()->school_id)->get(),
                $section_id
            );
        else
            return $this->userService->promoteSectionStudentsView([], [], $section_id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function promoteSectionStudentsPost(Request $request)
    {   
        return $this->userService->promoteSectionStudentsPost($request);
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

            return back()->with('status', __('Saved'));
        }

        return back()->with('error-status', __('Passwords do not match.'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonateGet()
    {
        if (app('impersonate')->isImpersonating()) {
            Auth::user()->leaveImpersonation();
            return (Auth::user()->role == 'master')?redirect('/masters') : redirect('/home');
        }
        else {
            return view('profile.impersonate', [
                'other_users' => $this->user->where('id', '!=', auth()->id())->get([ 'id', 'name', 'role' ])
            ]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function impersonate(ImpersonateUserRequest $request)
    {
        $user = $this->user->find($request->id);
        Auth::user()->impersonate($user);
        return redirect('/home');
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
            $password = $request->password;
            $tb = $this->userService->storeStudent($request);
            try {
                // Fire event to store Student information
                if(event(new StudentInfoUpdateRequested($request,$tb->id))){
                    // Fire event to send welcome email
                    event(new UserRegistered($tb, $password));
                } else {
                    throw new \Exeception('Event returned false');
                }
            } catch(\Exception $ex) {
                Log::info('Email failed to send to this address: '.$tb->email.'\n'.$ex->getMessage());
            }
        });

        return back()->with('status', __('Saved'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TCTCreateUserRequest $request
     *
     * 
     */
    public function tct_store(TCTCreateUserRequest $request)
    {
        // print($request);
        $tb = $this->userService->storeTCTStudent($request);
        event(new TCTStudentInfoUpdateRequested($request, $tb->id));
        return back()->with('status', __('Saved'));        
    }

    /**
     * @param CreateAdminRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAdmin(CreateAdminRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeAdmin($request);
        try {
            // Fire event to send welcome email
            // event(new userRegistered($userObject, $plain_password)); // $plain_password(optional)
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateTeacherRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeTeacher(CreateTeacherRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'teacher');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateAccountantRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAccountant(CreateAccountantRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'accountant');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * @param CreateLibrarianRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLibrarian(CreateLibrarianRequest $request)
    {
        $password = $request->password;
        $tb = $this->userService->storeStaff($request, 'librarian');
        try {
            // Fire event to send welcome email
            event(new UserRegistered($tb, $password));
        } catch(\Exception $ex) {
            Log::info('Email failed to send to this address: '.$tb->email);
        }

        return back()->with('status', __('Saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return UserResource
     */
    public function show($user_code)
    {
        $user = $this->userService->getUserByUserCode($user_code);


        return view('profile.user', compact('user'));
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
        $user = $this->user->find($id);
        $classes = Myclass::query()
            ->bySchool(\Auth::user()->school_id)
            ->pluck('id')
            ->toArray();

        $sections = Section::query()
            ->whereIn('class_id', $classes)
            ->get();

        $departments = Department::query()
            ->bySchool(\Auth::user()->school_id)
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
            $tb = $this->user->find($request->user_id);
            $tb->name = $request->name;
            $tb->email = (!empty($request->email)) ? $request->email : '';
            $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
            $tb->phone_number = $request->phone_number;
            $tb->address = (!empty($request->address)) ? $request->address : '';
            $tb->about = (!empty($request->about)) ? $request->about : '';
			if (!empty($request->pic_path)) {
				$tb->pic_path = $request->pic_path;
			}
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
                    try{
                        // Fire event to store Student information
                        event(new StudentInfoUpdateRequested($request,$tb->id));
                    } catch(\Exception $ex) {
                        Log::info('Failed to update Student information, Id: '.$tb->id. 'err:'.$ex->getMessage());
                    }
                }
            }
        });

        return back()->with('status', __('Saved'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function tct_administration_update(Request $request){
        // print($request);
        $tb = User::find($request->user_id)->studentInfo;
        $tb2 = User::find($request->user_id);

        if($tb->form_id != $request->section){
            $tb2 = User::find($request->user_id);
            $tb->form_id = $request->section;
            $tb->form_num = $this->userService->getMaxFormNumber($request->section);
            $tb2->section_id = $request->section;
            $tb2->save();

        }
        $tb->house_id = $request->house;
        $tb->group = $request->status;
        $tb->session = $request->session;
        $tb->reg_notes = $request->notes;
        $tb->save();

        return redirect("/user/$tb2->student_code");
    }

    public function tct_other_update(Request $request){
        // print($request);
        $tb = User::find($request->user_id)->studentInfo;
        $tb2 = User::find($request->user_id);

        $tb2->lst_name = $request->lst_name;
        $tb2->given_name = $request->given_name;
        $tb->birthday = $request->birthday;
        $tb->category_id = $request->category;
        $tb->church = $request->church;
        $tb2->village= $request->village;
        $tb2->nationality = $request->nationality;
        $tb2->blood_group = $request->blood_group;
        $tb->father_name = $request->father_name;
        $tb->father_phone_number = $request->father_phone_number;
        $tb->father_occupation = $request->father_occupation;
        $tb->mother_name = $request->mother_name;
        $tb->mother_phone_number = $request->mother_phone_number;
        $tb->mother_occupation = $request->mother_occupation;
        $tb->save();
        $tb2->save();

        return redirect("/user/$tb2->student_code");
    }

    public function promote_tct_student(Request $request){
        // print($request);

        // Insert into Regrecord
        $user = User::find($request->user_id);

        $tb = Regrecord::firstOrCreate(['user_id' => $request->user_id]);
        $tb->user_id = $user->id;
        $tb->session = $user->studentInfo->session;
        $tb->form_id = $user->studentInfo->form_id;
        $tb->form_num = $user->studentInfo->form_num;
        $tb->house_id = $user->studentInfo->house_id;
        $tb->status = $user->studentInfo->group;
        // $tb->reg_date = $user->studentInfo->updated
        $tb->notes = $user->StudentInfo->reg_notes;
        $tb->save();

        // Update StudentInfo Table
        $tb2 = $user->studentInfo;
        $tb2->form_id = $request->section;
        $tb2->form_num = $this->userService->getMaxFormNumber($request->section);
        $tb2->session = $request->session;
        $tb2->reg_notes = $request->notes;
        $tb2->section_id = $request->section;
        $tb2->group = $request->status;
        $tb2->save();

        return redirect("/user/$user->student_code");
    }

    /**
     * Activate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activateAdmin($id)
    {
        $admin = $this->user->find($id);

        if ($admin->active !== 0) {
            $admin->active = 0;
        } else {
            $admin->active = 1;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
    }

    /**
     * Deactivate admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deactivateAdmin($id)
    {
       $admin = $this->user->find($id);

        if ($admin->active !== 1) {
            $admin->active = 1;
        } else {
            $admin->active = 0;
        }

        $admin->save();

        return back()->with('status', __('Saved'));
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
        // return ($this->user->destroy($id))?response()->json([
      //   'status' => 'success'
      // ]):response()->json([
      //   'status' => 'error'
      // ]);
    }
}
