<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface PromotionRepository
{

    /**
     * @param $request
     * @param int $studentId
     * @return void
     * @throws \Exception
     */
    public function assignClassSection(array $request, int $studentId) : void;

    /**
     * @param $request
     * @param int $studentId
     * @return void
     * @throws \Exception
     */
    public function update(array $request, int $studentId) : void;

    /**
     * @param array $rows
     * @return void
     * @throws \Exception
     */
    public function massPromotion(array $rows) : void;

    /**
     * @param int $sessionId
     * @param int $classId
     * @param int $sectionId
     * @return Builder[]|Collection
     */
    public function getAll(int $sessionId, int $classId, int $sectionId);

    /**
     * @param int $sessionId
     * @return mixed
     */
    public function getAllStudentsBySessionCount(int $sessionId);

    /**
     * @param int $sessionId
     * @return mixed
     */
    public function getMaleStudentsBySessionCount(int $sessionId);

    /**
     * @param int $sessionId
     * @return Builder[]|Collection
     */
    public function getAllStudentsBySession(int $sessionId);

    /**
     * @param int $sessionId
     * @param int $studentId
     * @return Builder|Model|object|null
     */
    public function getPromotionInfoById(int $sessionId, int $studentId);


    /**
     * @param int $sessionId
     * @return Builder[]|Collection
     */
    public function getClasses(int $sessionId);

    /**
     * @param int $sessionId
     * @param int $classId
     * @return Builder[]|Collection
     */
    public function getSections(int $sessionId, int $classId);

    /**
     * @param int $sessionId
     * @return Builder[]|Collection
     */
    public function getSectionsBySession(int $sessionId);
}
