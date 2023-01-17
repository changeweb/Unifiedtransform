<?php

namespace App\Http\Controllers;

use App\Interfaces\PromotionRepository;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\SchoolSessionInterface;
use App\Interfaces\SectionInterface;
use App\Interfaces\UserInterface;
use App\Models\Promotion;
use App\Traits\SchoolSession;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    use SchoolSession;

    private $userRepository;

    private $schoolClassRepository;

    private $schoolSectionRepository;

    private $promotionRepository;

    /**
     * Create a new Controller instance
     *
     * @param SchoolSessionInterface $schoolSessionRepository
     * @return void
     */
    public function __construct(
        UserInterface        $userRepository,
        SchoolClassInterface $schoolClassRepository,
        SectionInterface     $schoolSectionRepository,
        PromotionRepository  $promotionRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->schoolClassRepository = $schoolClassRepository;
        $this->schoolSectionRepository = $schoolSectionRepository;
        $this->promotionRepository = $promotionRepository;
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $class_id = $request->query('class_id', 0);

        $previousSession = $this->schoolSessionRepository->getPreviousSession();

        if (count($previousSession) < 1) {
            return back()->withError('No previous session');
        }

        $previousSessionClasses = $this->promotionRepository->getClasses($previousSession['id']);

        $previousSessionSections = $this->promotionRepository->getSections($previousSession['id'], $class_id);

        $current_school_session_id = $this->getSchoolCurrentSession();
        $currentSessionSections = $this->promotionRepository->getSectionsBySession($current_school_session_id);

        $currentSessionSectionsCounts = $currentSessionSections->count();


        return view('promotions.index')
            ->with([
                'previousSessionClasses' => $previousSessionClasses,
                'class_id' => $class_id,
                'previousSessionSections' => $previousSessionSections,
                'currentSessionSectionsCounts' => $currentSessionSectionsCounts,
                'previousSessionId' => $previousSession['id'],
            ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $classId = $request->query('previous_class_id');
        $sectionId = $request->query('previous_section_id');
        $sessionId = $request->query('previousSessionId');

        try {
            if (is_null($classId) || is_null($sectionId) || is_null($sessionId)) {
                return abort(404);
            }

            $students = $this->userRepository->getAllStudents($sessionId, $classId, $sectionId);

            $schoolClass = $this->schoolClassRepository->findById($classId);
            $section = $this->schoolSectionRepository->findById($sectionId);

            $latestSchoolSession = $this->schoolSessionRepository->getLatestSession();

            $schoolClasses = $this->schoolClassRepository->getAllBySession($latestSchoolSession->id);


            return view('promotions.promote')
                ->with([
                    'students' => $students,
                    'schoolClass' => $schoolClass,
                    'section' => $section,
                    'school_classes' => $schoolClasses,
                ]);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_card_numbers = $request->id_card_number;
        $latest_school_session = $this->schoolSessionRepository->getLatestSession();

        $rows = [];
        $i = 0;
        foreach ($id_card_numbers as $student_id => $id_card_number) {
            $row = [
                'student_id' => $student_id,
                'id_card_number' => $id_card_number,
                'class_id' => $request->class_id[$i],
                'section_id' => $request->section_id[$i],
                'session_id' => $latest_school_session->id,
            ];
            array_push($rows, $row);
            $i++;
        }

        try {
            $this->promotionRepository->massPromotion($rows);
            return back()->with('status', 'Promoting students was successful!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Promotion $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
