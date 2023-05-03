<?php

namespace App\Http\Controllers;

use App\Interfaces\NoticeRepository;
use App\Interfaces\PromotionRepository;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\UserInterface;
use App\Traits\SchoolSession;

class HomeController extends Controller
{
    use SchoolSession;

    private $schoolClassRepository;

    private $userRepository;

    private $promotionRepository;

    private $noticeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserInterface        $userRepository,
        SchoolClassInterface $schoolClassRepository,
        PromotionRepository  $promotionRepository,
        NoticeRepository $noticeRepository
    )
    {
        // $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->promotionRepository = $promotionRepository;
        $this->noticeRepository = $noticeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentSchoolSessionId = $this->getSchoolCurrentSession();
        $classCount = $this->schoolClassRepository->getAllBySession($currentSchoolSessionId)->count();
        $studentCount = $this->userRepository->getAllStudentsBySessionCount($currentSchoolSessionId);
        $maleStudentsBySession = $this->promotionRepository->getMaleStudentsBySessionCount($currentSchoolSessionId);
        $teacherCount = $this->userRepository->getAllTeachers()->count();
        $notices = $this->noticeRepository->getAll($currentSchoolSessionId);

        return view('home')
            ->with([
                'classCount' => $classCount,
                'studentCount' => $studentCount,
                'teacherCount' => $teacherCount,
                'notices' => $notices,
                'maleStudentsBySession' => $maleStudentsBySession,
            ]);
    }
}
