<?php

namespace App\Interfaces;

interface SchoolClassInterface {
    public function create($request);

    public function getAllBySession($session_id);

    public function getAllBySessionAndTeacher($session_id, $teacher_id);

    public function getAllWithCoursesBySession($session_id);

    public function getClassesAndSections($session_id);

    public function findById($class_id);

    public function update($request);
}