<?php
namespace App\Services\User;

use App\User;
use App\StudentInfo;
use App\Inactive;
use Illuminate\Support\Facades\DB;
use Mavinoo\LaravelBatch\Batch;
use Illuminate\Support\Facades\Log;

class UserService {
    
    protected $user;
    protected $db;
    protected $batch;
    protected $st, $st2;

    public function __construct(User $user, DB $db, Batch $batch){
        $this->user = $user;
        $this->db = $db;
        $this->batch = $batch;
    }

    public function isListOfStudents($school_code, $student_code){
        return !empty($school_code) && $student_code == 1;
    }

    public function isListOfTeachers($school_code, $teacher_code){
        return !empty($school_code) && $teacher_code == 1;
    }

    public function indexView($view, $users){
        return view($view, [
            'users' => $users,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
        ]);
    }

    public function indexTCTView($view, $users, $type){
        return view($view, [
            'users' => $users,
            'type' => $type,
        ]);
    }

    public function hasSectionId($section_id){
        return $section_id > 0;
    }

    public function updateStudentInfo($request, $id){
        $info = StudentInfo::firstOrCreate(['student_id' => $id]);
        $info->student_id = $id;
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
        $info->user_id = auth()->user()->id;
        $info->save();
    }

    // Update Student Info TCT Registration
    public function updateTCTStudentInfo($request, $id){
        $info = StudentInfo::firstOrCreate(['student_id' => $id]);
        $info->student_id = $id;
        $info->session = (!empty($request->session)) ? $request->session : '';
        // $info->version = (!empty($request->version)) ? $request->version : '';
        $info->group = 'new';
        $info->birthday = (!empty($request->birthday)) ? $request->birthday : '';
        $info->religion = (!empty($request->religion)) ? $request->religion : '';
        $info->father_name = (!empty($request->father_name)) ? $request->father_name : '';
        $info->father_phone_number = (!empty($request->father_phone_number)) ? $request->father_phone_number : '';
        // $info->father_national_id = (!empty($request->father_national_id)) ? $request->father_national_id : '';
        $info->father_occupation = (!empty($request->father_occupation)) ? $request->father_occupation : '';
        // $info->father_designation = (!empty($request->father_designation)) ? $request->father_designation : '';
        // $info->father_annual_income = (!empty($request->father_annual_income)) ? $request->father_annual_income : '';
        $info->mother_name = (!empty($request->mother_name)) ? $request->mother_name : '';
        $info->mother_phone_number = (!empty($request->mother_phone_number)) ? $request->mother_phone_number : '';
        // $info->mother_national_id = (!empty($request->mother_national_id)) ? $request->mother_national_id : '';
        $info->mother_occupation = (!empty($request->mother_occupation)) ? $request->mother_occupation : '';
        // $info->mother_designation = (!empty($request->mother_designation)) ? $request->mother_designation : '';
        // $info->mother_annual_income = (!empty($request->mother_annual_income)) ? $request->mother_annual_income : '';
        $info->user_id = auth()->user()->id;
        // NEW COLUMNS
        $info->category_id = $request->category;
        $info->tct_id = $request->tct_id  ;
        $info->form_id = $request->section;
        $info->form_num = $this->getMaxFormNumber($request->section);
        $info->house_id = $request->house;
        $info->church = $request->church;
        $info->previous_form = $request->previous_form;
        $info->previous_school = $request->previous_school;
        $info->reg_notes = $request->notes;
        $info->save();
        // print($info);
    }
    // Check if current batch is NEW and whether a new student has been entered into this new batch
    public function getTCTID(){
        $year = date("Y");
        // $year = $session[0]->session_year;
        $subyr = substr($year, 2, 4);
        // Extract current tct_id batch
        if(DB::table('student_infos')->orderBy('tct_id', 'desc')->first()){
            $lastID = DB::table('student_infos')->max('tct_id');
            $lastIdsubyr = substr($lastID, 0, 2);
            $lastIdCount = substr($lastID, 2, 6);
            if($subyr === $lastIdsubyr){
                $new_id = $lastID + 1;
            } else{
                $new_id = $subyr.'0001';
                $new_id = (int)$new_id;
            }
        }
        else{
            $new_id = $subyr.'0001';
            $new_id = (int)$new_id;
        }
        return $new_id;
    }

    public function getFormNumbersArray($sections){
        $form_nums = [];
        foreach($sections as $section){
            $section_id = $section->id;
            $session = date("Y");
            $max_form = DB::table('student_infos')->where(['session' => $session, 'form_id'=> $section_id])->max('form_num');
            $max_form_num = ($max_form == NULL) ? 1 : $max_form + 1;
            $form_nums[$section_id] = $max_form_num;
        }
        return $form_nums;
    }

    public function getMaxFormNumber($section_id){
        $max_form = DB::table('student_infos')->where(['form_id'=> $section_id, 'session'=>date('Y')])->max('form_num');
        return ($max_form == NULL) ? 1 : $max_form + 1;
    }

    public function getInactiveRequest($user){
        // $inactive = $user->inactive->sortBy('created_at','desc')->first();
        $inactive = DB::table('inactives')->where('user_id', $user->id)->orderBy('created_at', 'desc')->first();
        return $inactive;
    }

    public function checkReinstate($user){
        $inactive_id = $this->getInactiveRequest($user)->id;
        return (count(DB::table('reinstates')->where('inactive_id', $inactive_id)->get())>0)? true:false;
    }

    public function getReinstateRequest($user){
        if($this->checkReinstate($user)){
            $inactive_id = $this->getInactiveRequest($user)->id;
            return DB::table('reinstates')->where('inactive_id', $inactive_id)->first();
        }
    }

    public function getRemainFromID($payments, $id, $curr=0){
        $assign = \App\Fee::find($id);
        $paid = $payments->where('fee_id', $id)->sum('amount');
        $remain = $assign->amount - $paid;
        return ($curr)? $this->numberformat($remain) : $remain;
    }

    public function getOldFees($session){
        if($session == 2017){
            $feeList['Term 1'] = 'term1';
            $feeList['Term 2'] = 'term2';
            $feeList['Term 3'] = 'term3';
            $feeList['Term 4'] = 'term4';
            $feeList['Magazine'] = 'magazine';
            $feeList['PTA'] = 'pta';
        } else{
            $feeList['School Fees'] = 'School Fees';
        }
            $feeList['Late Registration'] = 'late';
            $feeList['Bazaar (Old)'] = 'bazaar';
            $feeList['Bazaar (New)'] = 'bazaar';
        return $feeList;
        
    }

    public function getPayment($user_id, $session, $fee_id, $curr=0, $type=""){
        if($session > 2019){
            $payments = \App\Payment::where('user_id', $user_id)
                ->where('session', $session)
                ->orderby('receipt', 'desc')
                ->get();
            $payAmount = $payments->where('fee_id', $fee_id)->sum('amount');
        } else {
            // return 0;
            $feeList['Late Registration'] = 'late';
            $feeList['Magazine'] = 'magazine';
            $feeList['PTA'] = 'pta';
            $feeList['Bazaar (Old)'] = 'bazaar';
            $feeList['Bazaar (New)'] = 'bazaar';
            $payAmount = \App\PaymentMigrate::where('tct_id', \App\User::find($user_id)->studentInfo->tct_id)
                ->where('year', $session)
                ->where('fee_type', $feeList[$type])
                ->sum('amount');
        }
        return ($curr)? $this->numberformat($payAmount):$payAmount;
    }

    public function numberformat($amount){
        return ($amount == 0.00)?'-':number_format($amount,2);
    }

    public function paymentExists($fee_id, $session){
        return \App\Payment::where([
            'fee_id' => $fee_id,
            'session' => $session,
        ])->get();
    }

    public function oldPaymentExists($user_id, $type, $session){
        return \App\PaymentMigrate::where('year', $session)
            ->where('fee_type', $type)
            ->where('tct_id', $user_id)
            ->get();
    }

    public function getSchoolAssigned($user_id, $session, $curr =0){
        $feeTypeIDs = \App\FeeType::whereIn('name', ['Term 1', 'Term 2', 'Term 3', 'Term 4'])->pluck('id')->toArray();
        $feeUser = \App\Assign::where([
            'user_id' => $user_id,
            'session' => $session,
        ])->pluck('fee_id')->toArray();
        $feeSchool = \App\Fee::find($feeUser)->whereIn('fee_type_id', $feeTypeIDs)->sum('amount');
        return $feeSchool;
    }


    public function getAdminDetails()
    {
        $classes = \App\Myclass::with('sections')->where('school_id',\Auth::user()->school->id)->get();
        $classes_id = \App\Myclass::with('sections')->where('school_id',\Auth::user()->school->id)->pluck('id');
        $sections = \App\Section::with('class')
        ->whereIn('class_id',$classes_id)
        ->where('active', 1)
        ->get();
        $form_nums = $this->getFormNumbersArray($sections);
        $houses = \App\House::all();
        return array(
            'classes' => $classes,
            'classes_id' => $classes_id,
            'sections' => $sections,
            'form_nums' => $form_nums,
            'houses' => $houses,
        );
    }

    public function promoteSectionStudentsView($students, $classes, $section_id){
        return view('school.promote-students', compact('students','classes','section_id'));
    }
    
    public function promoteSectionStudentsPost($request)
    {   
        if ($request->section_id > 0) {
            $students = $this->getSectionStudentsWithStudentInfo($request, $request->section_id);
            $i = 0;
            foreach ($students as $student) {
                $this->st[] = [
                    'id' => $student->student_id,
                    'section_id' => $request->to_section[$i],
                    'active' => isset($request["left_school$i"])?0:1,
                ];

                $this->st2[] = [
                    'student_id' => $student->student_id,
                    'session' => $request->to_session[$i],
                ];
                ++$i;
            }
            $this->promoteSectionStudentsPostDBTransaction();
            
            return back()->with('status', 'Saved');
        }
    }

    public function promoteSectionStudentsPostDBTransaction(){
        return $this->db::transaction(function () {
            $table1 = 'users';
            $this->batch->update($table1, (array) $this->st, 'id');
            $table2 = 'student_infos';
            $this->batch->update($table2, (array) $this->st2, 'student_id');
        });
    }

    public function isAccountant($role){
        return $role == 'accountant';
    }

    public function isLibrarian($role){
        return $role == 'librarian';
    }

    public function indexOtherView($view, $users){
        return view($view, [
            'users' => $users,
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
        ]);
    }

    public function getStudents(){
        return $this->user->with(['section.class', 'school', 'studentInfo'])
                ->where('code', auth()->user()->school->code)
                ->student()
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public function getTCTStudents(){
        return User::whereHas("studentInfo", function($q){
                $q->where("session",date("Y"));
             })->where(['code' => auth()->user()->school->code], [])
             ->student()
             ->get();  
    }

    public function getTCTArchive(){
        return User::whereHas("studentInfo", function($q){
            $q->where("session", "!=", date("Y"));
            })->student()
            ->paginate(50);
    }

    public function getTeachers(){
        return $this->user->with(['section', 'school'])
                ->where('code', auth()->user()->school->code)
                ->where('role', 'teacher')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public function getAccountants(){
        return $this->user->with('school')
                ->where('code', auth()->user()->school->code)
                ->where('role', 'accountant')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public function getLibrarians(){
        return $this->user->with('school')
                ->where('code', auth()->user()->school->code)
                ->where('role', 'librarian')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public function getSectionStudentsWithSchool($section_id){
        return $this->user->with('school')
            ->student()
            ->where('section_id', $section_id)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getTCTSectionStudentsWithSchool($section_id){
        return $this->user->with('school')
            ->student()
            ->whereHas("studentInfo", function($q){
                $q->where('session', now()->year)
                ->orderBy('form_num', 'asc');
                })
            ->where('section_id', $section_id)
            ->where('active', 1)
            // ->orderBy('name', 'asc')
            ->get();
    }

    public function getSectionStudentsWithStudentInfo($request, $section_id){
		$ignoreSessions = $request->session()->get('ignoreSessions');
		
        if (isset($ignoreSessions) && $ignoreSessions == "true") {
			return $this->user->with(['section'])
                ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                //->where('student_infos.session', '<=', now()->year)
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->get();
		} else {
			return $this->user->with(['section'])
                ->join('student_infos', 'users.id', '=', 'student_infos.student_id')
                ->where('student_infos.session', '<=', now()->year)
                ->where('users.section_id', $section_id)
                ->where('users.active', 1)
                ->get();
		}
    }

    public function getSectionStudents($section_id){
        return $this->user->where('section_id', $section_id)
                ->where('active', 1)
                ->get();
    }

    public function getUserByUserCode($user_code){
        return $this->user->with('section', 'studentInfo')
              ->where('student_code', $user_code)
            //   ->where('active', 1)
              ->first();
    }

    public function storeAdmin($request){
        $tb = new $this->user;
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
        return $tb;
    }
    // TCT Registration for new students
    public function storeTCTStudent($request){
        $tb = new $this->user;
        $tb->lst_name = $request->lst_name; // LAST NAME
        $tb->given_name = $request->given_name; // GIVEN ANME
        $tb->name = $request->lst_name.' '.$request->given_name; // FULL NAME
        // $tb->email = (!empty($request->email)) ? $request->email : ''; 
        // $tb->password = bcrypt($request->password); 
        $tb->role = 'student';
        $tb->active = 1;
        $tb->school_id = auth()->user()->school_id;
        $tb->code = auth()->user()->code;// School Code
        $tb->student_code = $request->tct_id;
        $tb->gender = 'male';
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        // $tb->phone_number = $request->phone_number;
        $tb->village = (!empty($request->village)) ? $request->village : '';
        $tb->notes = (!empty($request->notes)) ? $request->notes : '';
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->section_id = $request->section;
        $tb->health_conditions = ($request->health_condition)? $request->health_condition : '';
        $tb->save();
        return $tb;
    }
    // Original query - registration for student
    public function storeStudent($request){
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = 'student';
        $tb->active = 1;
        $tb->school_id = auth()->user()->school_id;
        $tb->code = auth()->user()->code;// School Code
        $tb->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
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
        return $tb;
    }

    public function storeStaff($request, $role){
        $tb = new $this->user;
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = $role;
        $tb->active = 1;
        $tb->school_id = auth()->user()->school_id;
        $tb->code = auth()->user()->code;
        $tb->student_code = auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5);
        $tb->gender = $request->gender;
        $tb->blood_group = $request->blood_group;
        $tb->nationality = (!empty($request->nationality)) ? $request->nationality : '';
        $tb->phone_number = $request->phone_number;
        $tb->pic_path = (!empty($request->pic_path)) ? $request->pic_path : '';
        $tb->verified = 1;
        $tb->department_id = (!empty($request->department_id))?$request->department_id:0;
        
        if($role == 'teacher'){
            $tb->section_id = ($request->class_teacher_section_id != 0) ? $request->class_teacher_section_id : 0;
        }
        
        $tb->save();
        return $tb;
    }
}
