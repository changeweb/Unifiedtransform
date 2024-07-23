<?php

namespace App\Repositories;

use App\Interfaces\PromotionRepository;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PromotionRepositoryImpl implements PromotionRepository
{

    /**
     * @param $request
     * @param int $studentId
     * @return void
     * @throws \Exception
     */
    public function assignClassSection(array $request, int $studentId): void
    {
        try {
            Promotion::create([
                'student_id' => $studentId,
                'session_id' => $request['session_id'],
                'class_id' => $request['class_id'],
                'section_id' => $request['section_id'],
                'id_card_number' => $request['id_card_number'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to add Student. ' . $e->getMessage());
        }
    }

    /**
     * @param $request
     * @param int $studentId
     * @return void
     * @throws \Exception
     */
    public function update(array $request, int $studentId): void
    {
        try {
            Promotion::where('student_id', $studentId)->update([
                'id_card_number' => $request['id_card_number'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Student. ' . $e->getMessage());
        }
    }

    /**
     * @param array $rows
     * @return void
     * @throws \Exception
     */
    public function massPromotion(array $rows): void
    {
        try {
            foreach ($rows as $row) {
                Promotion::updateOrCreate([
                    'student_id' => $row['student_id'],
                    'session_id' => $row['session_id'],
                    'class_id' => $row['class_id'],
                    'section_id' => $row['section_id'],
                ], [
                    'id_card_number' => $row['id_card_number'],
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to promote students. ' . $e->getMessage());
        }
    }

    /**
     * @param int $sessionId
     * @param int $classId
     * @param int $sectionId
     * @return Builder[]|Collection
     */
    public function getAll(int $sessionId, int $classId, int $sectionId)
    {
        return Promotion::with(['student', 'section'])
            ->where('session_id', $sessionId)
            ->where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->get();
    }

    /**
     * @param int $sessionId
     * @return mixed
     */
    public function getAllStudentsBySessionCount(int $sessionId)
    {
        return Promotion::where('session_id', $sessionId)
            ->count();
    }

    /**
     * @param int $sessionId
     * @return mixed
     */
    public function getMaleStudentsBySessionCount(int $sessionId)
    {
        $allStudents = Promotion::where('session_id', $sessionId)->pluck('student_id')->toArray();

        return User::where('gender', 'Male')
            ->where('role', 'student')
            ->whereIn('id', $allStudents)
            ->count();
    }

    /**
     * @param int $sessionId
     * @return Builder[]|Collection
     */
    public function getAllStudentsBySession(int $sessionId)
    {
        return Promotion::with(['student', 'section'])
            ->where('session_id', $sessionId)
            ->get();
    }

    /**
     * @param int $sessionId
     * @param int $studentId
     * @return Builder|Model|object|null
     */
    public function getPromotionInfoById(int $sessionId, int $studentId)
    {
        return Promotion::with(['student', 'section'])
            ->where('session_id', $sessionId)
            ->where('student_id', $studentId)
            ->first();
    }


    /**
     * @param int $sessionId
     * @return Builder[]|Collection
     */
    public function getClasses(int $sessionId)
    {
        return Promotion::with('schoolClass')->select('class_id')
            ->where('session_id', $sessionId)
            ->distinct('class_id')
            ->get();
    }

    /**
     * @param int $sessionId
     * @param int $classId
     * @return Builder[]|Collection
     */
    public function getSections(int $sessionId, int $classId)
    {
        return Promotion::with('section')->select('section_id')
            ->where('session_id', $sessionId)
            ->where('class_id', $classId)
            ->distinct('section_id')
            ->get();
    }

    /**
     * @param int $sessionId
     * @return Builder[]|Collection
     */
    public function getSectionsBySession(int $sessionId)
    {
        return Promotion::with('section')->select('section_id')
            ->where('session_id', $sessionId)
            ->distinct('section_id')
            ->get();
    }
}
