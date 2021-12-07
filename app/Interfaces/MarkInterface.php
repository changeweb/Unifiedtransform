<?php

namespace App\Interfaces;

interface MarkInterface {
    public function create($rows);

    public function getAll($session_id, $semester_id, $class_id, $section_id, $course_id);

    public function getAllByStudentId($session_id, $semester_id, $class_id, $section_id, $course_id, $student_id);

    public function getAllFinalMarksByStudentId($session_id, $student_id, $semester_id, $class_id, $section_id, $course_id);

    public function storeFinalMarks($rows);
}