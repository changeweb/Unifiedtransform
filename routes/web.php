<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//in controller :- return (new ResultOutput())->output($data);
/*
class ResultOutput()
{
    private $type;
    public __construct(Request $request) {
        $this->output = 'view';
        if ($request->wantsJson()) {
            $this->output = 'json';
        }
    }
    public method output($data) {
        if ($this->type =='view') {
            // return the view with data
        } else {
            // return the json output
        }
    }
}
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function (){
  Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
  // Route::get('/view-attendance/section/{section_id}',function($section_id){
  //   if($section_id > 0){
  //     $attendances = App\Attendance::with(['student'])->where('section_id', $section_id)->get();
  //   }
  // });
  Route::get('attendances/students/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'AttendanceController@addStudentsToCourseBeforeAtt')->middleware(['teacher']);
  Route::get('attendances/{section_id}/{student_id}/{exam_id}', 'AttendanceController@index');
  Route::get('attendances/{section_id}', 'AttendanceController@sectionIndex')->middleware(['teacher']);
  Route::post('attendance/take-attendance','AttendanceController@store')->middleware(['teacher']);
  Route::get('attendance/adjust/{student_id}','AttendanceController@adjust')->middleware(['teacher']);
  Route::post('attendance/adjust','AttendanceController@adjustPost')->middleware(['teacher']);
});

Route::middleware(['auth','teacher'])->group(function (){
  Route::get('grades/all-exams-grade', 'GradeController@allExamsGrade');
  Route::get('grades/section/{section_id}', 'GradeController@gradesOfSection');
  Route::get('grades/{student_id}', 'GradeController@index');
  Route::get('grades/t/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@tindex')->name('teacher-grade');
  Route::get('grades/c/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@cindex');
  // Route::get('grades/c/store/{course_id}/{exam_id}/{teacher_id}/{section_id}', 'GradeController@store');
  Route::post('grades/calculate-marks','GradeController@calculateMarks');
  Route::post('grades/save-grade','GradeController@update');
});


Route::get('grades/{student_id}', 'GradeController@index')->middleware(['auth','student']);

Route::middleware(['auth','accountant'])->group(function (){
  Route::get('fees/all', 'FeeController@index');
  Route::get('fees/create', 'FeeController@create');
  Route::post('fees/create', 'FeeController@store');
});

Route::middleware(['auth','admin'])->group(function (){
  Route::get('gpa/create-gpa', 'GradesystemController@create');
  Route::post('create-gpa', 'GradesystemController@store');
  Route::post('gpa/delete', 'GradesystemController@destroy');
});

Route::middleware(['auth','teacher'])->group(function (){
  Route::get('gpa/all-gpa', 'GradesystemController@index');
});

Route::middleware(['auth'])->group(function (){
  Route::get('users/{school_code}/{student_code}/{teacher_code}', 'UserController@index');
  Route::get('users/{school_code}/{role}', 'UserController@indexOther');
  Route::get('user/{user_code}', 'UserController@create');
  Route::get('user/config/change_password', 'UserController@changePasswordGet');
  Route::post('user/config/change_password', 'UserController@changePasswordPost');
  Route::get('section/students/{section_id}', 'UserController@sectionStudents');
  
  Route::get('courses/{teacher_id}/{section_id}', 'CourseController@index');
});

Route::get('user/{id}/notifications', 'NotificationController@index')->middleware(['auth','student']);

Route::middleware(['auth','teacher'])->group(function (){
  Route::get('course/students/{teacher_id}/{course_id}/{exam_id}/{section_id}','CourseController@course');
  Route::post('courses/create', 'CourseController@create');
  // Route::post('courses/save-under-exam', 'CourseController@update');
  Route::post('courses/store', 'CourseController@store');
  Route::post('courses/save-configuration', 'CourseController@saveConfiguration');
});

Route::middleware(['auth','admin'])->group(function (){
  Route::get('academic/syllabus', 'SyllabusController@create');
  Route::get('academic/notice', 'NoticeController@create');
  Route::get('academic/event', 'EventController@create');
  Route::get('academic/routine', 'RoutineController@create');
  Route::get('academic/remove/syllabus/{id}', 'SyllabusController@update');
  Route::get('academic/remove/notice/{id}', 'NoticeController@update');
  Route::get('academic/remove/event/{id}', 'EventController@update');
  Route::get('academic/remove/routine/{id}', 'RoutineController@update');
});

Route::middleware(['auth','admin'])->group(function (){
  Route::get('exams', 'ExamController@index');
  Route::get('exams/create', 'ExamController@create');
  Route::post('exams/create', 'ExamController@store');
  Route::post('exams/activate-exam', 'ExamController@update');
});
Route::middleware(['auth','teacher'])->group(function (){
  Route::get('exams/active', 'ExamController@indexActive');
  Route::get('school/sections','SectionController@index');
});

Route::middleware(['auth','librarian'])->group(function (){
  Route::get('library/issue-books', 'IssuedbookController@create');
  Route::post('library/issue-books', 'IssuedbookController@store');
  Route::get('library/all-books', 'BookController@index');
  Route::get('library/issued-books', 'IssuedbookController@index');
  Route::get('library/add-new-book', 'BookController@create');
  Route::post('library/add-new-book', 'BookController@store');
  Route::post('library/save_as_returned', 'IssuedbookController@update');
});

Route::middleware(['auth','accountant'])->group(function (){
  Route::get('accounts/sectors','AccountController@sectors');
  Route::post('accounts/create-sector','AccountController@storeSector');
  Route::get('accounts/sector-list','AccountController@listSector');
  Route::get('accounts/edit-sector/{id}','AccountController@editSector');
  Route::post('accounts/update-sector','AccountController@updateSector');
  Route::get('accounts/delete-sector/{id}','AccountController@deleteSector');

  Route::get('accounts/income','AccountController@income');
  Route::post('accounts/create-income','AccountController@storeIncome');
  Route::get('accounts/income-list','AccountController@listIncome');
  Route::post('accounts/list-income','AccountController@postIncome');
  Route::get('accounts/edit-income/{id}','AccountController@editIncome');
  Route::post('accounts/update-income','AccountController@updateIncome');
  Route::get('accounts/delete-income/{id}','AccountController@deleteIncome');
  
  Route::get('accounts/expense','AccountController@expense');
  Route::post('accounts/create-expense','AccountController@storeExpense');
  Route::get('accounts/expense-list','AccountController@listExpense');
  Route::post('accounts/list-expense','AccountController@postExpense');
  Route::get('accounts/edit-expense/{id}','AccountController@editExpense');
  Route::post('accounts/update-expense','AccountController@updateExpense');
  Route::get('accounts/delete-expense/{id}','AccountController@deleteExpense');
});

Route::get('create-school', 'SchoolController@index')->middleware('master.admin');

Route::middleware(['auth','master'])->group(function (){
  Route::get('register/admin/{id}/{code}', function($id, $code){
      session([
        'register_role' => 'admin',
        'register_school_id' => $id,
        'register_school_code' => $code,
        ]);
      return redirect()->route('register');
  });
  Route::post('register/admin', 'UserController@storeAdmin');
  Route::get('master/activate-admin/{id}','UserController@activateAdmin');
  Route::get('master/deactivate-admin/{id}','UserController@deactivateAdmin');
  Route::post('create-school', 'SchoolController@store');
  Route::get('school/admin-list/{school_id}','SchoolController@show');
});
Route::middleware(['auth','admin'])->group(function (){
  Route::post('school/add-class','MyclassController@store');
  Route::post('school/add-section','SectionController@store');
  Route::post('school/add-department','SchoolController@addDepartment');
  Route::get('school/promote-students/{section_id}','UserController@promoteSectionStudents');
  Route::post('school/promote-students','UserController@promoteSectionStudentsPost');
  Route::post('school/theme','SchoolController@changeTheme');
  Route::get('register/student', 'UserController@redirectToRegisterStudent');
  Route::get('register/teacher', function(){
    $departments = \App\Department::where('school_id',\Auth::user()->school_id)->get();
    $classes = \App\Myclass::where('school_id',\Auth::user()->school->id)->pluck('id');
    $sections = \App\Section::with('class')->whereIn('class_id',$classes)->get();
    session([
      'register_role' => 'teacher',
      'departments' => $departments,
      'register_sections' => $sections
    ]);
    return redirect()->route('register');
  });
  Route::get('register/accountant', function(){
    session(['register_role' => 'accountant']);
    return redirect()->route('register');
  });
  Route::get('register/librarian', function(){
    session(['register_role' => 'librarian']);
    return redirect()->route('register');
  });
  Route::post('register/student', 'UserController@store');
  Route::post('register/teacher',  'UserController@storeTeacher');
  Route::post('register/accountant',  'UserController@storeAccountant');
  Route::post('register/librarian',  'UserController@storeLibrarian');

  Route::get('edit/course/{id}','CourseController@edit');
  Route::post('edit/course/{id}','CourseController@updateNameAndTime');
});



//use PDF;
Route::middleware(['auth','master.admin'])->group(function (){
  Route::get('edit/user/{id}','UserController@edit');
  Route::post('edit/user','UserController@update');
  Route::post('upload/file', 'UploadController@upload');
//   Route::get('pdf/profile/{user_id}',function($user_id){
//     $data = App\User::find($user_id);
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.profile-pdf', ['user' => $data]);
// 		return $pdf->stream('profile.pdf');
//   });
//   Route::get('pdf/result/{user_id}/{exam_id}',function($user_id, $exam_id){
//     $data = App\User::find($user_id);
//     $grades = App\Grade::with('exam')->where('student_id', $user_id)->where('exam_id',$exam_id)->latest()->get();
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.result-pdf', ['grades' => $grades, 'user'=>$data]);
// 		return $pdf->stream('result.pdf');
//   });
});
Route::middleware(['auth','teacher'])->group(function (){
  Route::post('calculate-marks','GradeController@calculateMarks');
  Route::post('message/students', 'NotificationController@store');
});
// Route::middleware(['auth'])->group(function (){
//   Route::get('download/pdf', function(){
//     $pathToFile = public_path('storage/Bano-EducationandAspiration.pdf');
//     return response()->download($pathToFile);
//   });
// });
