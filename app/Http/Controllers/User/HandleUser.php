<?php
namespace App\Http\Controllers\User;

use App\User;
use App\StudentInfo;
use Illuminate\Support\Facades\Auth;

class HandleUser {
    
    public function __construct(){
        //
    }

    public static function getStudents(){
        return User::with(['section.class', 'school', 'studentInfo'])
                ->where('code', Auth::user()->school->code)
                ->where('role', 'student')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public static function getTeachers(){
        return User::with(['section', 'school'])
                ->where('code', Auth::user()->school->code)
                ->where('role', 'teacher')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public static function getAccountants(){
        return User::with('school')
                ->where('code', Auth::user()->school->code)
                ->where('role', 'accountant')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public static function getLibrarians(){
        return User::with('school')
                ->where('code', Auth::user()->school->code)
                ->where('role', 'librarian')
                ->where('active', 1)
                ->orderBy('name', 'asc')
                ->paginate(50);
    }

    public static function getSectionStudentsWithSchool($section_id){
        return User::with('school')
            ->where('role', 'student')
            ->where('section_id', $section_id)
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
    }

    public static function getSectionStudentsWithStudentInfo($section_id){
        return User::with('section', 'studentInfo')
                ->where('section_id', $section_id)
                ->where('active', 1)
                ->get();
    }

    public static function getSectionStudents($section_id){
        return User::where('section_id', $section_id)
                ->where('active', 1)
                ->get();
    }

    public static function getUserByUserCode($user_code){
        return User::with('section', 'studentInfo')
              ->where('student_code', $user_code)
              ->where('active', 1)
              ->first();
    }

    public static function storeStudent($request){
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
        return $tb;
    }

    public static function storeAdmin($request){
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
        return $tb;
    }

    private function storeStaff($request, $role){
        $tb = new User();
        $tb->name = $request->name;
        $tb->email = (!empty($request->email)) ? $request->email : '';
        $tb->password = bcrypt($request->password);
        $tb->role = $role;
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
        $tb->department_id = (!empty($request->department_id))?$request->department_id:0;
        
        if($role == 'teacher'){
            $tb->section_id = ($request->class_teacher_section_id != 0) ? $request->class_teacher_section_id : 0;
        }
        
        $tb->save();
        return $tb;
    }
    
    public static function storeTeacher($request){
        return (new self)->storeStaff($request, 'teacher');
    }

    public static function storeAccountant($request){
        return (new self)->storeStaff($request, 'accountant');
    }

    public static function storeLibrarian($request){
        return (new self)->storeStaff($request, 'librarian');
    }

    public static function updateStudentInfo($request,$id){
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
        $info->user_id = Auth::user()->id;
        $info->save();
    }
}