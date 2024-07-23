<?php

namespace App\Http\Controllers;

use App\Interfaces\PromotionRepository;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Interfaces\UserInterface;
use App\Interfaces\SectionInterface;
use App\Interfaces\SchoolClassInterface;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\TeacherStoreRequest;
use App\Repositories\StudentParentInfoRepository;

class UserController extends Controller
{
    use SchoolSession;

    private $userRepository;

    private $schoolClassRepository;

    private $schoolSectionRepository;

    private $promotionRepository;

    public function __construct(UserInterface        $userRepository,
                                SchoolClassInterface $schoolClassRepository,
                                SectionInterface     $schoolSectionRepository,
                                PromotionRepository  $promotionRepository
    )
    {
        $this->middleware(['can:view users']);
        $this->userRepository = $userRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeacherStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeTeacher(TeacherStoreRequest $request)
    {
        try {
            $this->userRepository->createTeacher($request->validated());
            return back()->with('status', 'Teacher creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function getStudentList(Request $request)
    {
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $classId = $request->query('class_id', 0);
        $sectionId = $request->query('section_id', 0);

        try {
            $schoolClasses = $this->schoolClassRepository->getAllBySession($currentSchoolSessionId);
            $studentList = $this->userRepository->getAllStudents($currentSchoolSessionId, $classId, $sectionId);
            return view('students.list')
                ->with([
                    'studentList' => $studentList,
                    'school_classes' => $schoolClasses,
                ]);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }


    public function showStudentProfile($id)
    {
        $student = $this->userRepository->findStudent($id);
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $promotionInfo = $this->promotionRepository->getPromotionInfoById($currentSchoolSessionId, $id);
        return view('students.profile')
            ->with([
                'student' => $student,
                'promotion_info' => $promotionInfo,
            ]);
    }

    public function showTeacherProfile($id)
    {
        return view('teachers.profile')
            ->with(['teacher' => $this->userRepository->findTeacher($id)]);
    }


    public function createStudent()
    {
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $schoolClasses = $this->schoolClassRepository->getAllBySession($currentSchoolSessionId);
        return view('students.add')
            ->with([
                'current_school_session_id' => $currentSchoolSessionId,
                'school_classes' => $schoolClasses,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StudentStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeStudent(StudentStoreRequest $request)
    {
        try {
            $this->userRepository->createStudent($request->validated());
            return back()->with('status', 'Student creation was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function editStudent(int $studentId)
    {
        $student = $this->userRepository->findStudent($studentId);
        $studentParentInfoRepository = new StudentParentInfoRepository();
        $parentInfo = $studentParentInfoRepository->getParentInfo($studentId);
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $promotionInfo = $this->promotionRepository->getPromotionInfoById($currentSchoolSessionId, $studentId);
        return view('students.edit')
            ->with([
                'student' => $student,
                'parent_info' => $parentInfo,
                'promotion_info' => $promotionInfo,
            ]);
    }

    public function updateStudent(Request $request)
    {
        try {
            $this->userRepository->updateStudent($request->toArray());
            return back()->with('status', 'Student update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function editTeacher(int $teacherId)
    {
        return view('teachers.edit')
            ->with(['teacher' => $this->userRepository->findTeacher($teacherId)]);
    }

    public function updateTeacher(Request $request)
    {
        try {
            $this->userRepository->updateTeacher($request->toArray());
            return back()->with('status', 'Teacher update was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function getTeacherList()
    {
        return view('teachers.list')
            ->with(['teachers' => $this->userRepository->getAllTeachers()]);
    }
}
